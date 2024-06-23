using Microsoft.AspNetCore.Mvc.ModelBinding.Validation;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace AQ_Test.Models
{
    public class Client
    {

        
        public int Id { get; set; }

        [Required]
        public string Name { get; set; } = string.Empty;

        [Required]
        public string Lastname { get; set; } = string.Empty;

        [Required]
        public string Address { get; set; } = string.Empty;
        
        [Required]
        public string Email { get; set; } = string.Empty;

        [Required]
        public string Password { get; set; } = string.Empty;

        [Required]
        public string Country { get; set; } = string.Empty;

        public string? VatNumber { get; set; }

        public string? TaxCode { get; set; }

        [Column(TypeName = "tinyint")]
        public bool Newsletter { get; set; }

        [Required]
        [Column(TypeName = "tinyint")]
        public bool Privacy { get; set; }

        [Column(TypeName = "tinyint")]
        public bool Invoice { get; set; }

        [ValidateNever]
        public virtual List<Order> Orders { get; } = [];

        [ValidateNever]
        public Cart? Cart { get; set; }
    }
}
