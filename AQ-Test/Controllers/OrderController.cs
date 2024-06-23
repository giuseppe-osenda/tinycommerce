using AQ_Test.Models;
using Microsoft.AspNetCore.Mvc;
using AQ_Test.Data;
using Microsoft.AspNetCore.Mvc.Routing;
using Microsoft.EntityFrameworkCore;
using Microsoft.IdentityModel.Tokens;
using System.Collections.Generic;
using Stripe.Checkout;


namespace AQ_Test.Controllers
{
    public class OrderController : Controller
    {
        private readonly ApplicationDbContext _db;
        private readonly IHttpContextAccessor _httpContextAccessor;
        private readonly ILogger<OrderController> _logger;
        public OrderController(ApplicationDbContext db, IHttpContextAccessor httpContextAccessor, ILogger<OrderController> logger)
        {
            _db = db;
            _httpContextAccessor = httpContextAccessor;
            _logger = logger;
        }

        public IActionResult Index()
        {
            return View();
        }

        public IActionResult Checkout(string? cartId)
        {
            bool? isAuthenticated = HttpContext.User.Identity?.IsAuthenticated ?? false;
            int clientId;
            Client? client;

            if (cartId == null || isAuthenticated == false)
            {
                return RedirectToAction("Index", "Home");
            }


            Cart? cart = _db.Carts
             .Include(cp => cp.CartProducts)
             .ThenInclude(c => c.Product)
             .FirstOrDefault(c => c.Id == int.Parse(cartId));

            string? clientIdClaim = HttpContext.User.FindFirst("ClientId")?.Value;

            if (clientIdClaim != null)
            {
                clientId = int.Parse(clientIdClaim);
                client = _db.Clients.FirstOrDefault(cl => cl.Id == clientId);

                if (cart != null && client != null && cart.ClientId == clientId) //controllo di sicurezza sul carrello nel caso venisse cambiato client side
                {

                    var viewModel = new CheckoutViewModel
                    {
                        cart = cart,
                        client = client
                    };


                    return View(viewModel);
                }
                else
                {
                    return RedirectToAction("Index", "Home");
                }
            }
            else
            {
                return RedirectToAction("Index", "Home");
            }

        }


        [HttpPost]
        public IActionResult Checkout(string? cartId, string? paymentType, string? termsAndConditions)
        {


            bool? isAuthenticated = HttpContext.User.Identity?.IsAuthenticated ?? false;
            int clientId;
            Client? client;

            if (cartId == null || isAuthenticated == false)
            {
                return RedirectToAction("Index", "Home");
            }


            Cart? cart = _db.Carts
             .Include(cp => cp.CartProducts)
             .ThenInclude(c => c.Product)
             .FirstOrDefault(c => c.Id == int.Parse(cartId));

            string? clientIdClaim = HttpContext.User.FindFirst("ClientId")?.Value;

            if (clientIdClaim != null)
            {
                clientId = int.Parse(clientIdClaim);
                client = _db.Clients.FirstOrDefault(cl => cl.Id == clientId);
                
                if (cart != null && client != null && cart.ClientId == clientId) //controllo di sicurezza sul carrello nel caso venisse cambiato client side
                {
                    bool enoughProductQty = true;

                    foreach (CartProduct cartProduct in cart.CartProducts)
                    {
                        if(cartProduct.ProductQty > cartProduct.Product.StockQty)
                        {
                            TempData["ProductQtyError"] = true;
                            return RedirectToAction("Index", "Cart");
                        }
                    }

                    
                    //inserisco l'ordine
                    _db.Orders.Add(new Order
                    {
                        ClientId = client.Id,
                        Complete = false,
                        Invoice = client.Invoice,
                        OrderAddress = client.Address,
                        TotalPrice = cart.Total,
                        CreatedDate = DateTime.Now,
                        CompletedDate = null
                    });

                    try
                    {
                        _db.SaveChanges();
                    }
                    catch (Exception ex)
                    {
                        _logger.LogError(ex.Message);
                        return RedirectToAction("Index", "Cart");
                    }

                    Order? order = _db.Orders.FirstOrDefault(o => o.ClientId == client.Id);

                    if (order != null)
                    {
                        //costruisco la sessione stripe
                        var options = new SessionCreateOptions
                        {
                            SuccessUrl = $"https://localhost:7142/Order/Success?orderId={order.Id}",
                            CancelUrl = "https://localhost:7142/Order/Failure",
                            LineItems = new List<SessionLineItemOptions>(),
                            Mode = "payment",
                            CustomerEmail = client.Email
                        };

                        foreach (var cartProduct in cart.CartProducts)
                        {
                            //inserisco i prodotti nell'ordine
                            _db.OrderProduct.Add(new OrderProduct
                            {
                                OrderId = order.Id,
                                ProductId = cartProduct.ProductId,
                                CreatedDate = DateTime.Now,
                                Coupon = cartProduct.CouponCode,
                                DiscountedPrice = cartProduct.DiscountedPrice,
                                Price = cartProduct.Price,
                                ProductQty = cartProduct.ProductQty,
                                Total = cartProduct.Total,
                            });

                            //popolo la sessione
                            var sessionLineItem = new SessionLineItemOptions
                            {
                                PriceData = new SessionLineItemPriceDataOptions
                                {
                                    UnitAmount = (long)cartProduct.Price * 100,
                                    Currency = "EUR",
                                    ProductData = new SessionLineItemPriceDataProductDataOptions
                                    {
                                        Name = cartProduct.Product.Name
                                    }
                                },
                                Quantity = cartProduct.ProductQty
                            };
                            options.LineItems.Add(sessionLineItem);
                        }

                        var service = new SessionService();
                        Session session = service.Create(options);

                        Response.Headers.Add("Location", session.Url);
                        _db.SaveChanges();
                        return new StatusCodeResult(303);
                    }
                    else
                    {
                        TempData["OrderNotFound"] = true;
                        return RedirectToAction("Index", "Cart");
                    }
                }
            }

            return RedirectToAction("Checkout", new { cartId });

        }


        public IActionResult Success(string? orderId)
        {
            if (orderId != null)
            {
                Order? order = _db.Orders.FirstOrDefault(o => o.Id == int.Parse(orderId));

                if (order != null)
                {
                    order.Complete = true;
                    order.CompletedDate = DateTime.Now;
                    _db.Update(order);

                    try
                    {
                        _db.SaveChanges();
                    }
                    catch (Exception ex) {
                        _logger.LogError(ex.Message);
                        TempData["OrderCompleteUpdateFailure"] = true;
                        return RedirectToAction("Index", "Cart");
                    }

                    Cart? cart = _db.Carts.Include(c => c.CartProducts).ThenInclude(cp => cp.Product).FirstOrDefault(c => c.ClientId == order.ClientId);

                    if (cart != null) { 

                        foreach(CartProduct cartProduct in cart.CartProducts)
                        {
                            cartProduct.Product.StockQty -= cartProduct.ProductQty;
                        }

                        _db.Remove(cart);

                        try
                        {
                            _db.SaveChanges();
                        }
                        catch (Exception ex) {
                            _logger.LogError(ex.Message);
                            TempData["RetrieveCartToRemoveFailure"] = true;
                            return RedirectToAction("Index", "Cart");
                        }

                        return View();
                    }
                    else
                    {
                        return RedirectToAction("Index", "Cart");
                    }
                    
                }
            }

            return View("Failure");

        }

    }
}

