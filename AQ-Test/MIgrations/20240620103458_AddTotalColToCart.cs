using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class AddTotalColToCart : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 12, 34, 58, 536, DateTimeKind.Local).AddTicks(2899),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 9, 38, 27, 28, DateTimeKind.Local).AddTicks(1393));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 12, 34, 58, 536, DateTimeKind.Local).AddTicks(1667),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 9, 38, 27, 27, DateTimeKind.Local).AddTicks(9904));

            migrationBuilder.AddColumn<decimal>(
                name: "Total",
                table: "Carts",
                type: "money",
                nullable: false,
                defaultValue: 0m);

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 12, 34, 58, 536, DateTimeKind.Local).AddTicks(1945),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 9, 38, 27, 28, DateTimeKind.Local).AddTicks(230));
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "Total",
                table: "Carts");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 9, 38, 27, 28, DateTimeKind.Local).AddTicks(1393),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 12, 34, 58, 536, DateTimeKind.Local).AddTicks(2899));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 9, 38, 27, 27, DateTimeKind.Local).AddTicks(9904),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 12, 34, 58, 536, DateTimeKind.Local).AddTicks(1667));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 9, 38, 27, 28, DateTimeKind.Local).AddTicks(230),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 12, 34, 58, 536, DateTimeKind.Local).AddTicks(1945));
        }
    }
}
