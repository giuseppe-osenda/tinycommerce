using AQ_Test.Models;
using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;

namespace AQ_Test.Data
{
    public class ApplicationDbContext : DbContext
    {


        public ApplicationDbContext(DbContextOptions<ApplicationDbContext> options) : base(options)
        {

        }

        public DbSet<Cart> Carts { get; set; }
        public DbSet<CartProduct> CartProduct { get; set; }
        public DbSet<Client> Clients { get; set; }
        public DbSet<Coupon> Coupons { get; set; }
        public DbSet<Order> Orders { get; set; }
        public DbSet<OrderProduct> OrderProduct { get; set; }
        public DbSet<Product> Products { get; set; }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Coupon>().HasIndex(c => c.CouponCode).IsUnique();

            modelBuilder.Entity<Client>().HasIndex(cl => cl.TaxCode).IsUnique();
            modelBuilder.Entity<Client>().HasIndex(cl => cl.VatNumber).IsUnique();
            modelBuilder.Entity<Client>().HasIndex(cl => cl.Email).IsUnique();
            modelBuilder.Entity<Client>().Property(cl => cl.Privacy).HasDefaultValue(false);
            modelBuilder.Entity<Client>().Property(cl => cl.Newsletter).HasDefaultValue(false);
            modelBuilder.Entity<Client>().Property(cl => cl.Invoice).HasDefaultValue(false);
            modelBuilder.Entity<Client>().Property(cl => cl.VatNumber).HasDefaultValue(null);
            modelBuilder.Entity<Client>().Property(cl => cl.TaxCode).HasDefaultValue(null);

            modelBuilder.Entity<Cart>().Property(ca => ca.CreatedDate).HasDefaultValue(DateTime.Now);
            
            modelBuilder.Entity<CartProduct>().Property(cp => cp.CreatedDate).HasDefaultValue(DateTime.Now);
            modelBuilder.Entity<CartProduct>().Property(cp => cp.CouponCode).HasDefaultValue(string.Empty);
            modelBuilder.Entity<CartProduct>().Property(cp => cp.Total).HasDefaultValue(decimal.Zero);
            modelBuilder.Entity<CartProduct>().Property(cp => cp.DiscountedPrice).HasDefaultValue(decimal.Zero);
            modelBuilder.Entity<CartProduct>().Property(cp => cp.Price).HasDefaultValue(decimal.Zero);
            modelBuilder.Entity<CartProduct>().Property(cp => cp.Total).HasDefaultValue(decimal.Zero);

            modelBuilder.Entity<OrderProduct>().Property(op => op.CreatedDate).HasDefaultValue(DateTime.Now);
            modelBuilder.Entity<OrderProduct>().Property(op => op.DiscountedPrice).HasDefaultValue(decimal.Zero);
            modelBuilder.Entity<CartProduct>().Property(op => op.Price).HasDefaultValue(decimal.Zero);

            modelBuilder.Entity<Product>()
                .HasMany(e => e.Orders)
                .WithMany(e => e.Products)
                .UsingEntity<OrderProduct>();

            modelBuilder.Entity<Product>()
                .HasMany(e => e.Carts)
                .WithMany(e => e.Products)
                .UsingEntity<CartProduct>();


            modelBuilder.Entity<Coupon>().HasData(

                new Coupon { Id = 1, CouponCode = "BENVENUTO1", Active = 1, MinPrice = 10.0M, MaxPrice = 100.0M, Discount = 20 },

                new Coupon { Id = 2, CouponCode = "Bentornato", Active = 1, MinPrice = 50.0M, Discount = 50 },

                new Coupon { Id = 3, CouponCode = "nonvalid", Active = 0, MinPrice = 50.0M, MaxPrice = 150.0M, Discount = 15 }
            );

            modelBuilder.Entity<Product>().HasData(
                
                new Product { Id = 1, Name = "Prodotto 1", Price = 12.22M, StockQty = 10, Active = 1, CouponId = 2 },
                
                new Product { Id = 2, Name = "Prodotto 2", Price = 4.00M, StockQty = 3, Active = 1, CouponId = 1 },
                
                new Product { Id = 3, Name = "Prodotto 3", Price = 14.00M, StockQty = 20, Active = 1, CouponId = 3 },
                
                new Product { Id = 4, Name = "Prodotto 4", Price = 50.00M, StockQty = 1, Active = 1, CouponId = 1 }
                );
        }
    }
}
