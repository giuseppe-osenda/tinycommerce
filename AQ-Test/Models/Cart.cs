using Microsoft.AspNetCore.Mvc.ModelBinding.Validation;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace AQ_Test.Models
{
    public class Cart
    {

        public int Id { get; set; }
        public DateTime CreatedDate { get; set; } = DateTime.Now;

        /// <summary>
        /// one to one
        /// </summary>

        public int? ClientId { get; set; }

        [ValidateNever]
        public string? CookieId { get; set; } //if present identify the cart of an unregistered User

        [ForeignKey("ClientId")]
        [ValidateNever]
        public Client? Client { get; set; }

        [Column(TypeName = "money")]
        public decimal Total { get; set; }
        public virtual ICollection<Product> Products { get; } = [];

        public virtual ICollection<CartProduct> CartProducts { get; } = [];
    }
}
