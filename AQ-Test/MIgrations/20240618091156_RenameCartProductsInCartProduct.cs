using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class RenameCartProductsInCartProduct : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_CartProducts_Carts_CartId",
                table: "CartProducts");

            migrationBuilder.DropForeignKey(
                name: "FK_CartProducts_Products_ProductId",
                table: "CartProducts");

            migrationBuilder.DropPrimaryKey(
                name: "PK_CartProducts",
                table: "CartProducts");

            migrationBuilder.RenameTable(
                name: "CartProducts",
                newName: "CartProduct");

            migrationBuilder.RenameIndex(
                name: "IX_CartProducts_ProductId",
                table: "CartProduct",
                newName: "IX_CartProduct_ProductId");

            migrationBuilder.RenameIndex(
                name: "IX_CartProducts_CartId",
                table: "CartProduct",
                newName: "IX_CartProduct_CartId");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6586),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 10, 10, 889, DateTimeKind.Local).AddTicks(1692));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6117),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 10, 10, 889, DateTimeKind.Local).AddTicks(1245));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6400),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 10, 10, 889, DateTimeKind.Local).AddTicks(1558));

            migrationBuilder.AddPrimaryKey(
                name: "PK_CartProduct",
                table: "CartProduct",
                column: "Id");

            migrationBuilder.AddForeignKey(
                name: "FK_CartProduct_Carts_CartId",
                table: "CartProduct",
                column: "CartId",
                principalTable: "Carts",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);

            migrationBuilder.AddForeignKey(
                name: "FK_CartProduct_Products_ProductId",
                table: "CartProduct",
                column: "ProductId",
                principalTable: "Products",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_CartProduct_Carts_CartId",
                table: "CartProduct");

            migrationBuilder.DropForeignKey(
                name: "FK_CartProduct_Products_ProductId",
                table: "CartProduct");

            migrationBuilder.DropPrimaryKey(
                name: "PK_CartProduct",
                table: "CartProduct");

            migrationBuilder.RenameTable(
                name: "CartProduct",
                newName: "CartProducts");

            migrationBuilder.RenameIndex(
                name: "IX_CartProduct_ProductId",
                table: "CartProducts",
                newName: "IX_CartProducts_ProductId");

            migrationBuilder.RenameIndex(
                name: "IX_CartProduct_CartId",
                table: "CartProducts",
                newName: "IX_CartProducts_CartId");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 10, 10, 889, DateTimeKind.Local).AddTicks(1692),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6586));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 10, 10, 889, DateTimeKind.Local).AddTicks(1245),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6117));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProducts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 18, 11, 10, 10, 889, DateTimeKind.Local).AddTicks(1558),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 18, 11, 11, 56, 536, DateTimeKind.Local).AddTicks(6400));

            migrationBuilder.AddPrimaryKey(
                name: "PK_CartProducts",
                table: "CartProducts",
                column: "Id");

            migrationBuilder.AddForeignKey(
                name: "FK_CartProducts_Carts_CartId",
                table: "CartProducts",
                column: "CartId",
                principalTable: "Carts",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);

            migrationBuilder.AddForeignKey(
                name: "FK_CartProducts_Products_ProductId",
                table: "CartProducts",
                column: "ProductId",
                principalTable: "Products",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }
    }
}
