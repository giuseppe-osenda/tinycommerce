using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class UpdatedClientTable3 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropIndex(
                name: "IX_Clients_TaxCode",
                table: "Clients");

            migrationBuilder.DropIndex(
                name: "IX_Clients_VatNumber",
                table: "Clients");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 1, 53, 777, DateTimeKind.Local).AddTicks(2847),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 0, 10, 619, DateTimeKind.Local).AddTicks(9922));

            migrationBuilder.AlterColumn<string>(
                name: "VatNumber",
                table: "Clients",
                type: "nvarchar(450)",
                nullable: true,
                defaultValue: "",
                oldClrType: typeof(string),
                oldType: "nvarchar(450)",
                oldDefaultValue: "");

            migrationBuilder.AlterColumn<string>(
                name: "TaxCode",
                table: "Clients",
                type: "nvarchar(450)",
                nullable: true,
                defaultValue: "",
                oldClrType: typeof(string),
                oldType: "nvarchar(450)",
                oldDefaultValue: "");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 1, 53, 777, DateTimeKind.Local).AddTicks(1807),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 0, 10, 619, DateTimeKind.Local).AddTicks(8808));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 1, 53, 777, DateTimeKind.Local).AddTicks(2009),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 0, 10, 619, DateTimeKind.Local).AddTicks(9043));

            migrationBuilder.CreateIndex(
                name: "IX_Clients_TaxCode",
                table: "Clients",
                column: "TaxCode",
                unique: true,
                filter: "[TaxCode] IS NOT NULL");

            migrationBuilder.CreateIndex(
                name: "IX_Clients_VatNumber",
                table: "Clients",
                column: "VatNumber",
                unique: true,
                filter: "[VatNumber] IS NOT NULL");
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropIndex(
                name: "IX_Clients_TaxCode",
                table: "Clients");

            migrationBuilder.DropIndex(
                name: "IX_Clients_VatNumber",
                table: "Clients");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 0, 10, 619, DateTimeKind.Local).AddTicks(9922),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 1, 53, 777, DateTimeKind.Local).AddTicks(2847));

            migrationBuilder.AlterColumn<string>(
                name: "VatNumber",
                table: "Clients",
                type: "nvarchar(450)",
                nullable: false,
                defaultValue: "",
                oldClrType: typeof(string),
                oldType: "nvarchar(450)",
                oldNullable: true,
                oldDefaultValue: "");

            migrationBuilder.AlterColumn<string>(
                name: "TaxCode",
                table: "Clients",
                type: "nvarchar(450)",
                nullable: false,
                defaultValue: "",
                oldClrType: typeof(string),
                oldType: "nvarchar(450)",
                oldNullable: true,
                oldDefaultValue: "");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 0, 10, 619, DateTimeKind.Local).AddTicks(8808),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 1, 53, 777, DateTimeKind.Local).AddTicks(1807));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 0, 10, 619, DateTimeKind.Local).AddTicks(9043),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 1, 53, 777, DateTimeKind.Local).AddTicks(2009));

            migrationBuilder.CreateIndex(
                name: "IX_Clients_TaxCode",
                table: "Clients",
                column: "TaxCode",
                unique: true);

            migrationBuilder.CreateIndex(
                name: "IX_Clients_VatNumber",
                table: "Clients",
                column: "VatNumber",
                unique: true);
        }
    }
}
