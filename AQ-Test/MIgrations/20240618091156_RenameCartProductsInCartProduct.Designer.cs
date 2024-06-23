﻿// <auto-generated />
using System;
using AQ_Test.Data;
using Microsoft.EntityFrameworkCore;
using Microsoft.EntityFrameworkCore.Infrastructure;
using Microsoft.EntityFrameworkCore.Metadata;
using Microsoft.EntityFrameworkCore.Migrations;
using Microsoft.EntityFrameworkCore.Storage.ValueConversion;

#nullable disable

namespace AQ_Test.Migrations
{
    [DbContext(typeof(ApplicationDbContext))]
    [Migration("20240618091156_RenameCartProductsInCartProduct")]
    partial class RenameCartProductsInCartProduct
    {
        /// <inheritdoc />
        protected override void BuildTargetModel(ModelBuilder modelBuilder)
        {
#pragma warning disable 612, 618
            modelBuilder
                .HasAnnotation("ProductVersion", "8.0.6")
                .HasAnnotation("Relational:MaxIdentifierLength", 128);

            SqlServerModelBuilderExtensions.UseIdentityColumns(modelBuilder);

            modelBuilder.Entity("AQ_Test.Models.Cart", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    SqlServerPropertyBuilderExtensions.UseIdentityColumn(b.Property<int>("Id"));

                    b.Property<int>("ClientId")
                        .HasColumnType("int");

                    b.Property<DateTime>("CreatedDate")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("datetime2")
                        .HasDefaultValue(new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6117));

                    b.HasKey("Id");

                    b.HasIndex("ClientId")
                        .IsUnique();

                    b.ToTable("Carts");
                });

            modelBuilder.Entity("AQ_Test.Models.CartProduct", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    SqlServerPropertyBuilderExtensions.UseIdentityColumn(b.Property<int>("Id"));

                    b.Property<int>("CartId")
                        .HasColumnType("int");

                    b.Property<DateTime>("CreatedDate")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("datetime2")
                        .HasDefaultValue(new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6400));

                    b.Property<int>("ProductId")
                        .HasColumnType("int");

                    b.HasKey("Id");

                    b.HasIndex("CartId");

                    b.HasIndex("ProductId");

                    b.ToTable("CartProduct");
                });

            modelBuilder.Entity("AQ_Test.Models.Client", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    SqlServerPropertyBuilderExtensions.UseIdentityColumn(b.Property<int>("Id"));

                    b.Property<string>("Address")
                        .IsRequired()
                        .HasColumnType("nvarchar(max)");

                    b.Property<string>("Country")
                        .IsRequired()
                        .HasColumnType("nvarchar(max)");

                    b.Property<string>("Email")
                        .IsRequired()
                        .HasColumnType("nvarchar(450)");

                    b.Property<string>("Lastname")
                        .IsRequired()
                        .HasColumnType("nvarchar(max)");

                    b.Property<string>("Name")
                        .IsRequired()
                        .HasColumnType("nvarchar(max)");

                    b.Property<byte>("Newsletter")
                        .HasColumnType("tinyint");

                    b.Property<byte>("Privacy")
                        .HasColumnType("tinyint");

                    b.Property<string>("TaxCode")
                        .HasColumnType("nvarchar(450)");

                    b.Property<string>("VatNumber")
                        .HasColumnType("nvarchar(450)");

                    b.HasKey("Id");

                    b.HasIndex("Email")
                        .IsUnique();

                    b.HasIndex("TaxCode")
                        .IsUnique()
                        .HasFilter("[TaxCode] IS NOT NULL");

                    b.HasIndex("VatNumber")
                        .IsUnique()
                        .HasFilter("[VatNumber] IS NOT NULL");

                    b.ToTable("Clients");
                });

            modelBuilder.Entity("AQ_Test.Models.Coupon", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    SqlServerPropertyBuilderExtensions.UseIdentityColumn(b.Property<int>("Id"));

                    b.Property<byte>("Active")
                        .HasColumnType("tinyint");

                    b.Property<string>("CouponCode")
                        .IsRequired()
                        .HasMaxLength(10)
                        .HasColumnType("nvarchar(10)");

                    b.Property<int>("Discount")
                        .HasColumnType("int");

                    b.Property<decimal?>("MaxPrice")
                        .HasColumnType("decimal");

                    b.Property<decimal>("MinPrice")
                        .HasColumnType("decimal");

                    b.HasKey("Id");

                    b.HasIndex("CouponCode")
                        .IsUnique();

                    b.ToTable("Coupons");

                    b.HasData(
                        new
                        {
                            Id = 1,
                            Active = (byte)1,
                            CouponCode = "BENVENUTO1",
                            Discount = 20,
                            MaxPrice = 100.0m,
                            MinPrice = 10.0m
                        },
                        new
                        {
                            Id = 2,
                            Active = (byte)1,
                            CouponCode = "Bentornato",
                            Discount = 50,
                            MinPrice = 50.0m
                        },
                        new
                        {
                            Id = 3,
                            Active = (byte)0,
                            CouponCode = "nonvalid",
                            Discount = 15,
                            MaxPrice = 150.0m,
                            MinPrice = 50.0m
                        });
                });

            modelBuilder.Entity("AQ_Test.Models.Order", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    SqlServerPropertyBuilderExtensions.UseIdentityColumn(b.Property<int>("Id"));

                    b.Property<int>("ClientId")
                        .HasColumnType("int");

                    b.Property<byte>("Complete")
                        .HasColumnType("tinyint");

                    b.Property<DateTime?>("Completed")
                        .HasColumnType("datetime2");

                    b.Property<DateTime>("Created")
                        .HasColumnType("datetime2");

                    b.Property<byte>("Invoice")
                        .HasColumnType("tinyint");

                    b.Property<string>("OrderAddress")
                        .IsRequired()
                        .HasColumnType("nvarchar(max)");

                    b.Property<decimal>("TotalPrice")
                        .HasColumnType("Decimal");

                    b.HasKey("Id");

                    b.HasIndex("ClientId");

                    b.ToTable("Orders");
                });

            modelBuilder.Entity("AQ_Test.Models.OrderProduct", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    SqlServerPropertyBuilderExtensions.UseIdentityColumn(b.Property<int>("Id"));

                    b.Property<DateTime>("CreatedDate")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("datetime2")
                        .HasDefaultValue(new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6586));

                    b.Property<int>("OrdersId")
                        .HasColumnType("int");

                    b.Property<int>("ProductsId")
                        .HasColumnType("int");

                    b.HasKey("Id");

                    b.HasIndex("OrdersId");

                    b.HasIndex("ProductsId");

                    b.ToTable("OrderProduct");
                });

            modelBuilder.Entity("AQ_Test.Models.Product", b =>
                {
                    b.Property<int>("Id")
                        .ValueGeneratedOnAdd()
                        .HasColumnType("int");

                    SqlServerPropertyBuilderExtensions.UseIdentityColumn(b.Property<int>("Id"));

                    b.Property<byte>("Active")
                        .HasColumnType("tinyint");

                    b.Property<int>("CouponId")
                        .HasColumnType("int");

                    b.Property<string>("Name")
                        .IsRequired()
                        .HasColumnType("nvarchar(max)");

                    b.Property<decimal>("Price")
                        .HasColumnType("decimal");

                    b.Property<int>("StockQty")
                        .HasColumnType("int");

                    b.HasKey("Id");

                    b.HasIndex("CouponId");

                    b.ToTable("Products");

                    b.HasData(
                        new
                        {
                            Id = 1,
                            Active = (byte)1,
                            CouponId = 2,
                            Name = "Prodotto 1",
                            Price = 12.22m,
                            StockQty = 10
                        },
                        new
                        {
                            Id = 2,
                            Active = (byte)1,
                            CouponId = 1,
                            Name = "Prodotto 2",
                            Price = 4.00m,
                            StockQty = 3
                        },
                        new
                        {
                            Id = 3,
                            Active = (byte)1,
                            CouponId = 3,
                            Name = "Prodotto 3",
                            Price = 14.00m,
                            StockQty = 20
                        },
                        new
                        {
                            Id = 4,
                            Active = (byte)1,
                            CouponId = 1,
                            Name = "Prodotto 3",
                            Price = 50.00m,
                            StockQty = 1
                        });
                });

            modelBuilder.Entity("AQ_Test.Models.Cart", b =>
                {
                    b.HasOne("AQ_Test.Models.Client", "Client")
                        .WithOne("Cart")
                        .HasForeignKey("AQ_Test.Models.Cart", "ClientId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Client");
                });

            modelBuilder.Entity("AQ_Test.Models.CartProduct", b =>
                {
                    b.HasOne("AQ_Test.Models.Cart", null)
                        .WithMany()
                        .HasForeignKey("CartId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.HasOne("AQ_Test.Models.Product", null)
                        .WithMany()
                        .HasForeignKey("ProductId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();
                });

            modelBuilder.Entity("AQ_Test.Models.Order", b =>
                {
                    b.HasOne("AQ_Test.Models.Client", "Client")
                        .WithMany("Orders")
                        .HasForeignKey("ClientId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Client");
                });

            modelBuilder.Entity("AQ_Test.Models.OrderProduct", b =>
                {
                    b.HasOne("AQ_Test.Models.Order", null)
                        .WithMany()
                        .HasForeignKey("OrdersId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.HasOne("AQ_Test.Models.Product", null)
                        .WithMany()
                        .HasForeignKey("ProductsId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();
                });

            modelBuilder.Entity("AQ_Test.Models.Product", b =>
                {
                    b.HasOne("AQ_Test.Models.Coupon", "Coupon")
                        .WithMany("Products")
                        .HasForeignKey("CouponId")
                        .OnDelete(DeleteBehavior.Cascade)
                        .IsRequired();

                    b.Navigation("Coupon");
                });

            modelBuilder.Entity("AQ_Test.Models.Client", b =>
                {
                    b.Navigation("Cart");

                    b.Navigation("Orders");
                });

            modelBuilder.Entity("AQ_Test.Models.Coupon", b =>
                {
                    b.Navigation("Products");
                });
#pragma warning restore 612, 618
        }
    }
}
