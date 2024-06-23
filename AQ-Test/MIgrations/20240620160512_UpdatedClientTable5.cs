using System;
using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace AQ_Test.Migrations
{
    /// <inheritdoc />
    public partial class UpdatedClientTable5 : Migration
    {
        /// <inheritdoc />
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 5, 11, 900, DateTimeKind.Local).AddTicks(4565),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 3, 47, 750, DateTimeKind.Local).AddTicks(3061));

            migrationBuilder.AlterColumn<byte>(
                name: "Newsletter",
                table: "Clients",
                type: "tinyint",
                nullable: false,
                defaultValue: (byte)0,
                oldClrType: typeof(byte),
                oldType: "tinyint",
                oldNullable: true,
                oldDefaultValue: (byte)0);

            migrationBuilder.AlterColumn<byte>(
                name: "Invoice",
                table: "Clients",
                type: "tinyint",
                nullable: false,
                defaultValue: (byte)0,
                oldClrType: typeof(byte),
                oldType: "tinyint",
                oldNullable: true,
                oldDefaultValue: (byte)0);

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 5, 11, 900, DateTimeKind.Local).AddTicks(3478),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 3, 47, 750, DateTimeKind.Local).AddTicks(1966));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 5, 11, 900, DateTimeKind.Local).AddTicks(3713),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 3, 47, 750, DateTimeKind.Local).AddTicks(2169));
        }

        /// <inheritdoc />
        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "OrderProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 3, 47, 750, DateTimeKind.Local).AddTicks(3061),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 5, 11, 900, DateTimeKind.Local).AddTicks(4565));

            migrationBuilder.AlterColumn<byte>(
                name: "Newsletter",
                table: "Clients",
                type: "tinyint",
                nullable: true,
                defaultValue: (byte)0,
                oldClrType: typeof(byte),
                oldType: "tinyint",
                oldDefaultValue: (byte)0);

            migrationBuilder.AlterColumn<byte>(
                name: "Invoice",
                table: "Clients",
                type: "tinyint",
                nullable: true,
                defaultValue: (byte)0,
                oldClrType: typeof(byte),
                oldType: "tinyint",
                oldDefaultValue: (byte)0);

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "Carts",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 3, 47, 750, DateTimeKind.Local).AddTicks(1966),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 5, 11, 900, DateTimeKind.Local).AddTicks(3478));

            migrationBuilder.AlterColumn<DateTime>(
                name: "CreatedDate",
                table: "CartProduct",
                type: "datetime2",
                nullable: false,
                defaultValue: new DateTime(2024, 6, 20, 18, 3, 47, 750, DateTimeKind.Local).AddTicks(2169),
                oldClrType: typeof(DateTime),
                oldType: "datetime2",
                oldDefaultValue: new DateTime(2024, 6, 20, 18, 5, 11, 900, DateTimeKind.Local).AddTicks(3713));
        }
    }
}
