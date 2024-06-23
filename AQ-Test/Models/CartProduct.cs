using Microsoft.AspNetCore.Mvc.ModelBinding.Validation;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace AQ_Test.Models
{
    public class CartProduct
    {
        public int Id { get; set; }
        public int CartId { get; set; }
        public int ProductId { get; set; }
        public int ProductQty { get; set; } = 0;
        public string CouponCode { get; set; } = string.Empty;

        [Column(TypeName ="money")]
        public decimal Price { get; set; } = decimal.Zero;

        [Column(TypeName = "money")]
        public decimal DiscountedPrice { get; set; } = decimal.Zero;

        public DateTime CreatedDate { get; set; } = DateTime.Now;

        [Column(TypeName = "money")]
        public decimal Total { get; set; } = decimal.Zero;

        public Product Product { get; set; } = null!;

        public Cart Cart { get; set; } = null!;
    }
}
