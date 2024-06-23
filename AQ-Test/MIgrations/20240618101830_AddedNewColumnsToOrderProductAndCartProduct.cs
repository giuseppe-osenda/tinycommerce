using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class AddedNewColumnsToOrderProductAndCartProduct : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<decimal>(
                name: "Price",
                table: "Products",
                type: "money",
                nullable: false,
                oldClrType: typeof(decimal),
                oldType: "decimal(18,0)");

            migrationBuilder.AlterColumn<decimal>(
                name: "TotalPrice",
                table: "Orders",
                type: "money",
                nullable: false,
                oldClrType: typeof(decimal),
                oldType: "Decimal(18,0)");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(5264),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6586));

            migrationBuilder.AddColumn<string>(
                name: "Coupon",
                table: "OrderProduct",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");

            migrationBuilder.AddColumn<decimal>(
                name: "DiscountedPrice",
                table: "OrderProduct",
                type: "money",
                nullable: false,
                defaultValue: 0m);

            migrationBuilder.AddColumn<decimal>(
                name: "Price",
                table: "OrderProduct",
                type: "money",
                nullable: false,
                defaultValue: 0m);

            migrationBuilder.AddColumn<int>(
                name: "ProductQty",
                table: "OrderProduct",
                type: "int",
                nullable: false,
                defaultValue: 0);

            migrationBuilder.AlterColumn<decimal>(
                name: "MinPrice",
                table: "Coupons",
                type: "money",
                nullable: false,
                oldClrType: typeof(decimal),
                oldType: "decimal(18,0)");

            migrationBuilder.AlterColumn<decimal>(
                name: "MaxPrice",
                table: "Coupons",
                type: "money",
                nullable: true,
                oldClrType: typeof(decimal),
                oldType: "decimal(18,0)",
                oldNullable: true);

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4266),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6117));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4559),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6400));

            migrationBuilder.AddColumn<string>(
                name: "CouponCode",
                table: "CartProduct",
                type: "nvarchar(max)",
                nullable: false,
                defaultValue: "");

            migrationBuilder.AddColumn<decimal>(
                name: "DiscountedPrice",
                table: "CartProduct",
                type: "money",
                nullable: false,
                defaultValue: 0m);

            migrationBuilder.AddColumn<decimal>(
                name: "Price",
                table: "CartProduct",
                type: "money",
                nullable: false,
                defaultValue: 0m);

            migrationBuilder.AddColumn<decimal>(
                name: "Total",
                table: "CartProduct",
                type: "money",
                nullable: false,
                defaultValue: 0m);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "Coupon",
                table: "OrderProduct");

            migrationBuilder.DropColumn(
                name: "DiscountedPrice",
                table: "OrderProduct");

            migrationBuilder.DropColumn(
                name: "Price",
                table: "OrderProduct");

            migrationBuilder.DropColumn(
                name: "ProductQty",
                table: "OrderProduct");

            migrationBuilder.DropColumn(
                name: "CouponCode",
                table: "CartProduct");

            migrationBuilder.DropColumn(
                name: "DiscountedPrice",
                table: "CartProduct");

            migrationBuilder.DropColumn(
                name: "Price",
                table: "CartProduct");

            migrationBuilder.DropColumn(
                name: "Total",
                table: "CartProduct");

            migrationBuilder.AlterColumn<decimal>(
                name: "Price",
                table: "Products",
                type: "decimal(18,0)",
                nullable: false,
                oldClrType: typeof(decimal),
                oldType: "money");

            migrationBuilder.AlterColumn<decimal>(
                name: "TotalPrice",
                table: "Orders",
                type: "Decimal(18,0)",
                nullable: false,
                oldClrType: typeof(decimal),
                oldType: "money");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6586),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(5264));

            migrationBuilder.AlterColumn<decimal>(
                name: "MinPrice",
                table: "Coupons",
                type: "decimal(18,0)",
                nullable: false,
                oldClrType: typeof(decimal),
                oldType: "money");

            migrationBuilder.AlterColumn<decimal>(
                name: "MaxPrice",
                table: "Coupons",
                type: "decimal(18,0)",
                nullable: true,
                oldClrType: typeof(decimal),
                oldType: "money",
                oldNullable: true);

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6117),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4266));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6400),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4559));
        }
    }
}
