using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class AddedProductQtyToCartProduct : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 27, 28, 685, DateTimeKind.Local).AddTicks(2832),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(5264));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 27, 28, 685, DateTimeKind.Local).AddTicks(1806),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4266));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 27, 28, 685, DateTimeKind.Local).AddTicks(2076),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4559));

            migrationBuilder.AddColumn<int>(
                name: "ProductQty",
                table: "CartProduct",
                type: "int",
                nullable: false,
                defaultValue: 0);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "ProductQty",
                table: "CartProduct");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(5264),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 27, 28, 685, DateTimeKind.Local).AddTicks(2832));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4266),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 27, 28, 685, DateTimeKind.Local).AddTicks(1806));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 12, 18, 29, 958, DateTimeKind.Local).AddTicks(4559),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 12, 27, 28, 685, DateTimeKind.Local).AddTicks(2076));
        }
    }
}
