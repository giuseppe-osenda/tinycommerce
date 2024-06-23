using System.ComponentModel.DataAnnotations.Schema;

namespace AQ_Test.Models
{
    public class OrderProduct
    {
        public int Id { get; set; }

        public int OrderId { get; set; }

        public int ProductId { get; set; }

        public int ProductQty { get; set; } = 0;

        [Column(TypeName = "money")]
        public decimal Price { get; set; } = 0;

        [Column(TypeName = "money")]
        public decimal DiscountedPrice { get; set; } = 0;

        public string Coupon { get; set; } = string.Empty;

        [Column(TypeName = "money")]
        public decimal Total { get; set; } = decimal.Zero;

        public Product Product { get; set; } = null!;

        public Order order { get; set; } = null!;

        public DateTime CreatedDate { get; set; } = DateTime.Now;
    }
}
