using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class AddedCookieIdToCart : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 10, 35, 29, 957, DateTimeKind.Local).AddTicks(7792),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 14, 19, 44, 230, DateTimeKind.Local).AddTicks(4220));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 10, 35, 29, 957, DateTimeKind.Local).AddTicks(6622),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 14, 19, 44, 230, DateTimeKind.Local).AddTicks(3042));

            migrationBuilder.AddColumn<string>(
                name: "CookieId",
                table: "Carts",
                type: "nvarchar(max)",
                nullable: true);

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 10, 35, 29, 957, DateTimeKind.Local).AddTicks(6914),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 14, 19, 44, 230, DateTimeKind.Local).AddTicks(3354));
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropColumn(
                name: "CookieId",
                table: "Carts");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 14, 19, 44, 230, DateTimeKind.Local).AddTicks(4220),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 10, 35, 29, 957, DateTimeKind.Local).AddTicks(7792));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 14, 19, 44, 230, DateTimeKind.Local).AddTicks(3042),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 10, 35, 29, 957, DateTimeKind.Local).AddTicks(6622));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 14, 19, 44, 230, DateTimeKind.Local).AddTicks(3354),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 10, 35, 29, 957, DateTimeKind.Local).AddTicks(6914));
        }
    }
}
