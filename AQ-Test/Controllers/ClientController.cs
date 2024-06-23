using AQ_Test.Data;
using AQ_Test.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using BCrypt.Net;
using Microsoft.IdentityModel.Tokens;
using System.Security.Claims;
using Microsoft.AspNetCore.Authentication.Cookies;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.AspNetCore.Mvc.Routing;

namespace AQ_Test.Controllers
{
    public class ClientController : Controller
    {
        private readonly ApplicationDbContext _db;
        private readonly IHttpContextAccessor _httpContextAccessor;
        private readonly ILogger<ClientController> _logger;
        private List<SelectListItem> countries = new List<SelectListItem>
            {
                new SelectListItem { Value = "IT", Text = "Italy" },
                new SelectListItem { Value = "FR", Text = "France" },
                new SelectListItem { Value = "DE", Text = "Germany" },
                new SelectListItem { Value = "ES", Text = "Spain" }
            };

        public ClientController(ApplicationDbContext db, IHttpContextAccessor httpContextAccessor, ILogger<ClientController> logger)
        {
            _db = db;
            _httpContextAccessor = httpContextAccessor;
            _logger = logger;
        }

        public IActionResult Index()
        {

            return View();
        }
        public IActionResult Register()
        {

            ViewBag.countries = countries;

            return View();
        }

        [HttpPost]
        public async Task<IActionResult> Register(Client candidate)
        {
            ViewBag.countries = countries;

            if (ModelState.IsValid)
            {
                try
                {
                    _db.Clients.Add(new Client
                    {
                        Email = candidate.Email,
                        Password = BCrypt.Net.BCrypt.HashPassword(candidate.Password),
                        Name = candidate.Name,
                        Lastname = candidate.Lastname,
                        Country = candidate.Country,
                        Address = candidate.Address,
                        VatNumber = candidate.VatNumber,
                        Newsletter = candidate.Newsletter,
                        Privacy = candidate.Privacy,
                        TaxCode = candidate.TaxCode,
                    });

                    _db.SaveChanges();

                }
                catch (Exception)
                {

                    return View();

                }
            }
            else
            {
                return View();
            }

            Client? newClient = _db.Clients.FirstOrDefault(c => c.Email == candidate.Email);

            if (newClient != null)
            {
                var claims = new List<Claim>
                        {
                            new Claim(ClaimTypes.Name, newClient.Name),
                            new Claim(ClaimTypes.Email, newClient.Email),
                            new Claim("ClientId", newClient.Id.ToString()),
                        };

                var claimsIdentity = new ClaimsIdentity(claims, CookieAuthenticationDefaults.AuthenticationScheme);

                var authProperties = new AuthenticationProperties
                {
                    IsPersistent = true
                };

                await HttpContext.SignInAsync(CookieAuthenticationDefaults.AuthenticationScheme,
                    new ClaimsPrincipal(claimsIdentity),
                    authProperties);

                var cartId = HttpContext.Request.Cookies["CartId"]; // get the cart id from the cookie

                if (cartId != null)
                {
                    HttpContext.Response.Cookies.Delete("CartId"); //delete the cookie

                    Cart? cart = _db.Carts.FirstOrDefault(c => c.CookieId == cartId);
                    if (cart != null)
                    {
                        cart.CookieId = null;
                        cart.ClientId = newClient.Id;
                        _db.Update(cart);

                        try
                        {
                            _db.SaveChanges();
                        }
                        catch (Exception ex)
                        {
                            _logger.LogError(ex.Message);
                        }
                    }
                }

            }
            return RedirectToAction("Index", "Cart");
        }


        public IActionResult Login() { return View(); }

        [HttpPost]
        public async Task<IActionResult> Login(Client loggingClient)
        {
            bool passwordVerify = false;

            if (loggingClient.Email.IsNullOrEmpty() || loggingClient.Password.IsNullOrEmpty())
            {
                return View();

            }
            else
            {
                Client clientRecord = _db.Clients.First(cl => cl.Email.ToLower() == loggingClient.Email.ToLower());

                if (clientRecord != null && !clientRecord.Password.IsNullOrEmpty())
                {
                    passwordVerify = BCrypt.Net.BCrypt.Verify(loggingClient.Password, clientRecord.Password);

                    if (passwordVerify)
                    {
                        var claims = new List<Claim>
                        {
                            new Claim(ClaimTypes.Name, clientRecord.Name),
                            new Claim(ClaimTypes.Email, clientRecord.Email),
                            new Claim("ClientId", clientRecord.Id.ToString()),
                        };

                        var claimsIdentity = new ClaimsIdentity(claims, CookieAuthenticationDefaults.AuthenticationScheme);

                        var authProperties = new AuthenticationProperties
                        {
                            IsPersistent = true
                        };

                        await HttpContext.SignInAsync(CookieAuthenticationDefaults.AuthenticationScheme,
                            new ClaimsPrincipal(claimsIdentity),
                            authProperties);

                    }
                }

            }

            if (!passwordVerify)
            {
                return View();
            }

            return RedirectToAction("Index", "Home");

        }

        public async Task<IActionResult> Logout()
        {
            await HttpContext.SignOutAsync(CookieAuthenticationDefaults.AuthenticationScheme);

            return RedirectToAction("Index", "Cart");
        }

        public IActionResult PersonalArea()
        {
            string? clientIdClaim = HttpContext.User.FindFirst("ClientId")?.Value;

            if (clientIdClaim != null)
            {
                int clientId = int.Parse(clientIdClaim);
                Client? client = _db.Clients.FirstOrDefault(cl => cl.Id == clientId);

                if (client != null)
                {
                    return View(client);
                }
            }

            TempData["ClientIdNotFound"] = true;
            return RedirectToAction("Index", "Home");
        }

    }
}
