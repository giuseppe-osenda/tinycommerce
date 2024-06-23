using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class UpdatedOrderTable : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<bool>(
                name: "Invoice",
                table: "Orders",
                type: "bit",
                nullable: false,
                oldClrType: typeof(byte),
                oldType: "tinyint");

            migrationBuilder.AlterColumn<bool>(
                name: "Complete",
                table: "Orders",
                type: "bit",
                nullable: false,
                oldClrType: typeof(byte),
                oldType: "tinyint");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 21, 14, 19, 23, 412, DateTimeKind.Local).AddTicks(416),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 21, 14, 9, 10, 371, DateTimeKind.Local).AddTicks(1859));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 21, 14, 19, 23, 411, DateTimeKind.Local).AddTicks(9207),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 21, 14, 9, 10, 371, DateTimeKind.Local).AddTicks(806));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 21, 14, 19, 23, 411, DateTimeKind.Local).AddTicks(9441),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 21, 14, 9, 10, 371, DateTimeKind.Local).AddTicks(1005));
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<byte>(
                name: "Invoice",
                table: "Orders",
                type: "tinyint",
                nullable: false,
                oldClrType: typeof(bool),
                oldType: "bit");

            migrationBuilder.AlterColumn<byte>(
                name: "Complete",
                table: "Orders",
                type: "tinyint",
                nullable: false,
                oldClrType: typeof(bool),
                oldType: "bit");

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 21, 14, 9, 10, 371, DateTimeKind.Local).AddTicks(1859),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 21, 14, 19, 23, 412, DateTimeKind.Local).AddTicks(416));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 21, 14, 9, 10, 371, DateTimeKind.Local).AddTicks(806),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 21, 14, 19, 23, 411, DateTimeKind.Local).AddTicks(9207));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 21, 14, 9, 10, 371, DateTimeKind.Local).AddTicks(1005),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 21, 14, 19, 23, 411, DateTimeKind.Local).AddTicks(9441));
        }
    }
}
