using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class ClientIdNullableOnCartTable : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Carts_Clients_ClientId",
                table: "Carts");

            migrationBuilder.DropIndex(
                name: "IX_Carts_ClientId",
                table: "Carts");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 11, 24, 54, 160, DateTimeKind.Local).AddTicks(4967),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 11, 6, 45, 675, DateTimeKind.Local).AddTicks(7300));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 11, 24, 54, 160, DateTimeKind.Local).AddTicks(3938),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 11, 6, 45, 675, DateTimeKind.Local).AddTicks(6277));

            migrationBuilder.AlterColumn<int>(
                name: "ClientId",
                table: "Carts",
                type: "int",
                nullable: true,
                oldClrType: typeof(int),
                oldType: "int");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 11, 24, 54, 160, DateTimeKind.Local).AddTicks(4219),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 11, 6, 45, 675, DateTimeKind.Local).AddTicks(6545));

            migrationBuilder.CreateIndex(
                name: "IX_Carts_ClientId",
                table: "Carts",
                column: "ClientId",
                unique: true,
                filter: "[ClientId] IS NOT NULL");

            migrationBuilder.AddForeignKey(
                name: "FK_Carts_Clients_ClientId",
                table: "Carts",
                column: "ClientId",
                principalTable: "Clients",
                principalColumn: "Id");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Carts_Clients_ClientId",
                table: "Carts");

            migrationBuilder.DropIndex(
                name: "IX_Carts_ClientId",
                table: "Carts");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 11, 6, 45, 675, DateTimeKind.Local).AddTicks(7300),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 11, 24, 54, 160, DateTimeKind.Local).AddTicks(4967));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 11, 6, 45, 675, DateTimeKind.Local).AddTicks(6277),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 11, 24, 54, 160, DateTimeKind.Local).AddTicks(3938));

            migrationBuilder.AlterColumn<int>(
                name: "ClientId",
                table: "Carts",
                type: "int",
                nullable: false,
                defaultValue: 0,
                oldClrType: typeof(int),
                oldType: "int",
                oldNullable: true);

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 19, 11, 6, 45, 675, DateTimeKind.Local).AddTicks(6545),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 19, 11, 24, 54, 160, DateTimeKind.Local).AddTicks(4219));

            migrationBuilder.CreateIndex(
                name: "IX_Carts_ClientId",
                table: "Carts",
                column: "ClientId",
                unique: true);

            migrationBuilder.AddForeignKey(
                name: "FK_Carts_Clients_ClientId",
                table: "Carts",
                column: "ClientId",
                principalTable: "Clients",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }
    }
}
