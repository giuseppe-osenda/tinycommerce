using Microsoft.AspNetCore.Mvc.ModelBinding.Validation;
using Microsoft.EntityFrameworkCore;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace AQ_Test.Models
{
    public class Product
    {

        public int Id { get; set; }

        [Required]
        public string Name { get; set; } = string.Empty;

        [Column(TypeName = "money")]
        public decimal Price { get; set; }

        [Required]
        [DefaultValue(0)]
        public int StockQty { get; set; }

        [Column(TypeName = "tinyint")]
        [Required]
        [DefaultValue(0)]
        public byte Active { get; set; } = 0;

        public int CouponId { get; set; }

        [ForeignKey("CouponId")]
        public Coupon? Coupon { get; set; }
    
        public virtual ICollection<Order> Orders { get; } = [];
        public virtual ICollection<OrderProduct> OrderProducts { get; } = [];

        public virtual ICollection<Cart> Carts { get; } = [];
        public virtual ICollection<CartProduct> CartProducts { get; } = [];
    }
}
