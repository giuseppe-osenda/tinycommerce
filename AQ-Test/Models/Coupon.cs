using Microsoft.EntityFrameworkCore;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace AQ_Test.Models
{
    public class Coupon
    {

        public int Id { get; set; }

        [Required]
        [MaxLength(10)]
        public string CouponCode { get; set; } = string.Empty;

        [Column(TypeName = "tinyint")]
        [Required]
        [DefaultValue(0)]
        public byte Active { get; set; } = 0;

        [Required]
        [DefaultValue(0.0)]
        [Column(TypeName = "money")]
        public decimal MinPrice { get; set; } = decimal.Zero;

        [Column(TypeName = "money")]
        public decimal? MaxPrice { get; set; }

        [Required]
        [DefaultValue(0)]
        public int Discount { get; set; } = 0;

        public virtual List<Product>? Products { get; set; }
    }
}
