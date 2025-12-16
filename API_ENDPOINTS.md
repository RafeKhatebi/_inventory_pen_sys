# API Endpoints Documentation

## Base URL: `http://127.0.0.1:8000/api`

## Authentication
- **POST** `/login` - Login user
- **POST** `/logout` - Logout user (requires token)

## Products (Admin only)
- **GET** `/products` - List all products
- **POST** `/products` - Create product
- **GET** `/products/{id}` - Get product
- **PUT** `/products/{id}` - Update product
- **DELETE** `/products/{id}` - Delete product

## Customers (Admin only)
- **GET** `/customers` - List all customers
- **POST** `/customers` - Create customer
- **GET** `/customers/{id}` - Get customer
- **PUT** `/customers/{id}` - Update customer
- **DELETE** `/customers/{id}` - Delete customer

## Warehouse (Admin only)
- **GET** `/warehouse` - List warehouse items
- **POST** `/warehouse` - Create warehouse item
- **GET** `/warehouse/{id}` - Get warehouse item
- **PUT** `/warehouse/{id}` - Update warehouse item
- **DELETE** `/warehouse/{id}` - Delete warehouse item

## Orders (Admin only)
- **GET** `/orders` - List all orders
- **POST** `/orders` - Create order
- **GET** `/orders/{id}` - Get order details
- **PUT** `/orders/{id}` - Update order
- **DELETE** `/orders/{id}` - Delete order
- **PUT** `/orders/{id}/status` - Update order status

## Inventory Reports (Admin only)
- **GET** `/reports/stock` - Stock level report
- **GET** `/reports/low-stock` - Low stock items
- **GET** `/reports/sales` - Sales report
- **GET** `/reports/orders` - Orders report

## Stock Management (Admin only)
- **POST** `/stock/adjust` - Adjust stock levels
- **GET** `/stock/movements` - Stock movement history
- **POST** `/stock/transfer` - Transfer stock between warehouses

## Categories (Admin only)
- **GET** `/categories` - List all categories
- **POST** `/categories` - Create category
- **GET** `/categories/{id}` - Get category
- **PUT** `/categories/{id}` - Update category
- **DELETE** `/categories/{id}` - Delete category

## Suppliers (Admin only)
- **GET** `/suppliers` - List all suppliers
- **POST** `/suppliers` - Create supplier
- **GET** `/suppliers/{id}` - Get supplier
- **PUT** `/suppliers/{id}` - Update supplier
- **DELETE** `/suppliers/{id}` - Delete supplier

## Headers Required:
```
Authorization: Bearer {token}
Content-Type: application/json
Accept: application/json
```

## Response Format:
```json
{
  "success": true,
  "data": {},
  "message": "Operation successful"
}
```

## Error Response:
```json
{
  "success": false,
  "message": "Error description",
  "errors": {}
}
```