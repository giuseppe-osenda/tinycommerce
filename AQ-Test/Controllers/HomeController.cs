using AQ_Test.Data;
using AQ_Test.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Diagnostics;

namespace AQ_Test.Controllers
{
    public class HomeController : Controller
    {
        private readonly ILogger<HomeController> _logger;
        private readonly ApplicationDbContext _db;


        public HomeController(ApplicationDbContext db, ILogger<HomeController> logger)
        {
            _logger = logger;
            _db = db;
        }

        public IActionResult Index()
        {
            List<Product> products = _db.Products.ToList();

            if (TempData["ClientIdNotFound"] != null)
            {
                ViewBag.ClientIdNotFound = "Non è stato possibile recuperare il tuo id cliente";
            }

            bool? isAuthenticated = HttpContext.User?.Identity?.IsAuthenticated;

            if (isAuthenticated ?? false) //routine per ripulire il db da un cliente eliminato dal db ma ancora loggato
            {
                string? clientIdClaim = HttpContext.User?.FindFirst("ClientId")?.Value;

                if (clientIdClaim != null)
                {
                    int clientId = int.Parse(clientIdClaim);
                    Client? client = _db.Clients.FirstOrDefault(c => c.Id == clientId);

                    if (client == null) //se non trovo un cliente nel db con l'id ripulisco il db
                    {
                        Cart? cart = _db.Carts.FirstOrDefault(c => c.ClientId == clientId);

                        if (cart != null)
                        {
                            _db.Remove(cart);

                            try
                            {
                                _db.SaveChanges();
                            }
                            catch (Exception ex) {
                                _logger.LogError(ex.Message);
                            }
                        }
                    }
                }
            }

            return View(products);
        }

        public IActionResult Privacy()
        {
            return View();
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
