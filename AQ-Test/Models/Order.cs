using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace AQ_Test.Models
{
    public class Order
    {
        public int Id { get; set; }

        [Required]
        [Column(TypeName = "money")]
        public decimal TotalPrice { get; set; } = decimal.Zero;

        [Required]
        public bool Invoice { get; set; }

        [Required]
        public string OrderAddress { get; set; } = string.Empty;

        [Required]
        public bool Complete { get; set; }

        [Required]
        public DateTime CreatedDate { get; set; } = DateTime.Now;
        
        public DateTime? CompletedDate { get; set; }

        /// <summary>
        /// One to Many
        /// </summary>
        [Required]
        public int ClientId { get; set; }

        [ForeignKey("ClientId")]
        public virtual Client Client { get; set; } = null!;

        
        public virtual ICollection<Product> Products { get; } = [];
        public virtual ICollection<OrderProduct> OrderProducts { get; } = [];
    }
}
