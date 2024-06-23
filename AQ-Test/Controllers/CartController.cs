using AQ_Test.Data;
using AQ_Test.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using Microsoft.IdentityModel.Tokens;

namespace AQ_Test.Controllers
{
    public class CartController : Controller
    {

        private readonly ApplicationDbContext _db;
        private readonly IHttpContextAccessor _httpContextAccessor;
        private readonly ILogger<CartController> _logger;
        public CartController(ApplicationDbContext db, IHttpContextAccessor httpContextAccessor, ILogger<CartController> logger)
        {
            _db = db;
            _httpContextAccessor = httpContextAccessor;
            _logger = logger;
        }

        public IActionResult Index()
        {
            if (TempData["ProductQtyError"] != null)
            {
                // Handle the error, maybe set a ViewBag property here
                ViewBag.ProductQtyError = "Some products in your cart has gone out of stock";
            }

            bool? isAuthenticated = HttpContext.User.Identity?.IsAuthenticated ?? false;
            Cart? cart = null;

            if (isAuthenticated == true)
            {
                string? clientIdClaim = HttpContext.User.FindFirst("ClientId")?.Value;

                if (clientIdClaim != null)
                {
                    int clientId = int.Parse(clientIdClaim);

                    cart = _db.Carts
                     .Include(cp => cp.CartProducts)
                     .ThenInclude(c => c.Product)
                     .FirstOrDefault(c => c.ClientId == clientId);

                    if (cart != null)
                    {
                        UpdateCart(cart);
                    }
                    else
                    {
                      
                        return RedirectToAction("Index", "Home");
                    }

                }
            }
            else
            {
                var cartId = HttpContext.Request.Cookies["CartId"]; // get the cart id from the cookie

                if (cartId.IsNullOrEmpty()) // if the cart id is not found in the cookie
                {
                    ViewBag.ErrorMessage = "Can't retrieve user cartId from Cookie";
                    return RedirectToAction("Index", "Home");
                }
                else
                {
                    cart = _db.Carts
                         .Include(cp => cp.CartProducts)
                         .ThenInclude(c => c.Product)
                         .FirstOrDefault(c => c.CookieId == cartId);


                    if (cart != null)
                    {
                        UpdateCart(cart);
                    }
                    else
                    {
                        ViewBag.ErrorMessage = "Can't retrieve user cart";
                        return RedirectToAction("Index", "Home");
                    }

                }
            }

            return View(cart);
        }

        protected bool UpdateCart(Cart cart)
        {
            cart.Total = cart.CartProducts.Sum(cp => cp.Total);

            _db.Carts.Update(cart);

            foreach (CartProduct cartProduct in cart.CartProducts)
            {
                if (cartProduct.CouponCode.IsNullOrEmpty())
                {
                    cartProduct.Total = cartProduct.Price * cartProduct.ProductQty;
                }
                else
                {
                    cartProduct.Total = cartProduct.DiscountedPrice * cartProduct.ProductQty;
                }
                _db.CartProduct.Update(cartProduct);
            }

            try
            {
                _db.SaveChanges();
            }
            catch (Exception ex)
            {
                return false;
            }

            return true;
        }
        
        protected bool AddUpdate(Cart? cart, int? productId, int? quantity)
        {
            bool isSuccess = true;

            try // try to save the product in the cart
            {

                if (cart != null && productId.HasValue && quantity.HasValue)
                {


                    CartProduct? cartProduct = _db.CartProduct.FirstOrDefault(cp => cp.CartId == cart.Id && cp.ProductId == productId);
                    Product? product = _db.Products.FirstOrDefault(p => p.Id == productId);

                    if (cartProduct == null && product != null) //add new record
                    {
                        _db.CartProduct.Add(new CartProduct
                        {
                            CartId = cart.Id,
                            ProductId = product.Id,
                            CreatedDate = DateTime.Now,
                            Price = product.Price,
                            Total = (decimal)(product.Price * quantity),
                            ProductQty = (int)quantity
                        });
                    }
                    else if (cartProduct != null && product != null) //update record
                    {
                        cartProduct.ProductQty += (int)quantity;
                        cartProduct.Price = product.Price;
                        cartProduct.Total = cartProduct.Price * cartProduct.ProductQty;
                        _db.CartProduct.Update(cartProduct);
                    }

                    try
                    {
                        cart.Total = cart.CartProducts.Sum(cp => cp.Total);

                        _db.Update(cart);

                        _db.SaveChanges();
                    }
                    catch (Exception ex)
                    {
                        _logger.LogError(ex, "An error occurred while updating the cart.");
                    }

                }

                isSuccess = false;

            }
            catch (Exception)
            {
                isSuccess = false;
            }

            return isSuccess;
        }

        [HttpPost]
        public IActionResult AddToCart(int? productId, int? quantity)
        {
            bool isSuccess = false;

            bool? isAuthenticated = HttpContext.User.Identity?.IsAuthenticated ?? false;

            if (isAuthenticated == true)
            {
                string? clientIdClaim = HttpContext.User.FindFirst("ClientId")?.Value;

                if (clientIdClaim != null)
                {
                    int clientId = int.Parse(clientIdClaim);

                    Cart? cart = _db.Carts.Include(c => c.CartProducts).FirstOrDefault(c => c.ClientId == clientId);

                    if (cart == null)
                    {
                        try
                        {
                            _db.Carts.Add(new Cart
                            {
                                ClientId = clientId,
                                CreatedDate = DateTime.Now,
                            });

                            _db.SaveChanges();

                            cart = _db.Carts.Include(c => c.CartProducts).FirstOrDefault(c => c.ClientId == clientId);

                        }
                        catch (Exception ex)
                        {
                            _logger.LogError(ex.Message);
                            ViewBag.ErrorMessage = "An error occurred while processing your request. Please try again later.";
                            return RedirectToAction("Index", "Home");
                        }
                    }

                    isSuccess = AddUpdate(cart, productId, quantity);
                }

                if (!isSuccess)
                {
                    _logger.LogError("Failed to add or update the cart product.");
                    ViewBag.ErrorMessage = "An error occurred while adding the product to your cart. Please try again later.";
                }

            }
            else //Unregistered User
            {
                var cartId = HttpContext.Request.Cookies["CartId"]; // get the cart id from the cookie

                if (cartId.IsNullOrEmpty()) // if the cart id is not found in the cookie let's create cookie and new cart for the user
                {
                    cartId = Guid.NewGuid().ToString();
                    var cookieOptions = new CookieOptions { Expires = DateTime.Now.AddDays(30), Secure = true, IsEssential = true };
                    HttpContext.Response.Cookies.Append("CartId", cartId, cookieOptions); // create a new cookie with the cart id

                    try // try to save the cart id in the database
                    {
                        _db.Carts.Add(new Cart
                        {
                            CookieId = cartId,
                            CreatedDate = DateTime.Now,
                        });

                        _db.SaveChanges();
                    }
                    catch (Exception)
                    {

                        ViewBag.ErrorMessage = "An error occured while creating your cart, please try again";
                        return RedirectToAction("Index", "Home");
                    }
                }
              

                Cart? cart = _db.Carts.Include(c => c.CartProducts).FirstOrDefault(c => c.CookieId.Equals(cartId));

                isSuccess = AddUpdate(cart, productId, quantity);

                if (!isSuccess)
                {
                    _logger.LogError("Failed to add or update the cart product.");
                    ViewBag.ErrorMessage = "An error occurred while adding the product to your cart. Please try again later.";
                }

            }

            return RedirectToAction("Index", "Home");
        }

        [Route("/Cart/DeleteFromCart")]
        public IActionResult DeleteFromCart(string cartProductId)
        {
            if (!cartProductId.IsNullOrEmpty())
            {

                CartProduct? cartProduct = _db.CartProduct.FirstOrDefault(cp => cp.Id == int.Parse(cartProductId));

                if (cartProduct != null)
                {
                    _db.Remove<CartProduct>(cartProduct);
                    _db.SaveChanges();
                }
                else
                {
                    ViewBag.ErrorMessage = "An error occured while trying to delete the product";
                    _logger.LogError($"Failed to find cartProduct with id: {cartProductId} for remove");
                }

            }

            return RedirectToAction("Index");
        }

        [HttpPost]
        public IActionResult UpdateQuantity(int? cartProductId, int quantity)
        {

            if (cartProductId.HasValue)
            {
                CartProduct? cartProduct = _db.CartProduct.FirstOrDefault(cp => cp.Id == cartProductId);

                if (cartProduct != null)
                {
                    cartProduct.ProductQty = quantity;

                    try
                    {
                        _db.Update<CartProduct>(cartProduct);
                        _db.SaveChanges();
                    }
                    catch (Exception ex)
                    {
                        ViewBag.Error = "An error occurred";
                        _logger.LogError(ex.Message);
                    }

                }
                else
                {
                    ViewBag.Error = "An error occurred while retrieving your product, please add the item again";
                }

            }

            return RedirectToAction("Index", "Cart");
        }

        [HttpPost]
        public IActionResult ApplyCoupon(string? couponCode, int? cartId)
        {
            Coupon? coupon;
            bool usedCoupon = false;
            bool isCouponValid = false;

            List<CartProduct> cartProducts = _db.CartProduct
                .Include(cp => cp.Product)
                .Where(cp => cp.CartId == cartId)
                .ToList();

            Cart? cart = _db.Carts.Include(c => c.CartProducts).FirstOrDefault(c => c.Id == cartId);

            if (couponCode != null && cart != null && cart.CartProducts.Count > 0)
            {
                coupon = _db.Coupons.FirstOrDefault(c => c.CouponCode.ToLower().Equals(couponCode.ToLower()));

                if (coupon != null)
                {
                    switch (coupon.MaxPrice)
                    {
                        case null:
                            isCouponValid = coupon != null && coupon.Active == 1 && cart.Total > coupon.MinPrice;
                            break;
                        default:
                            isCouponValid = coupon != null && coupon.Active == 1 && cart.Total < coupon.MaxPrice && cart.Total > coupon.MinPrice;
                            break;
                    }


                    if (isCouponValid && cartProducts.Count > 0)
                    {

                        foreach (CartProduct cartProduct in cartProducts)
                        {
                            if (cartProduct.Product.CouponId == coupon.Id)
                            {
                                decimal cartProductTotalTemp = cartProduct.Total;
                                decimal cartProductPriceTemp = cartProduct.Price;
                                cartProduct.CouponCode = coupon.CouponCode;
                                cartProduct.Total -= cartProductTotalTemp * ((decimal)coupon.Discount / 100);
                                cartProduct.DiscountedPrice = cartProduct.Price - (cartProductPriceTemp * ((decimal)coupon.Discount / 100));
                                usedCoupon = true;
                                _db.Update(cartProduct);
                            }
                        }

                        if (usedCoupon)
                        {
                            try
                            {
                                cart.Total = cart.CartProducts.Sum(cp => cp.Total);

                                _db.Update(cart);

                                _db.SaveChanges();
                            }
                            catch (Exception ex)
                            {
                                _logger.LogError(ex, "An error occurred while updating the cart during coupon apply.");
                            }
                        }
                        else
                        {
                            return Json(new { success = false });
                        }
                    }
                    else
                    {
                        return Json(new { success = false });
                    }

                }
                else
                {
                    return Json(new { success = false });
                }

            }
            else
            {
                return Json(new { success = false }); 
            }

            return Json(new { success = true });
        }
    }
}
