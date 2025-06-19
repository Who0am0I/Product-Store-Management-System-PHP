# Product Store Management System

A complete PHP-based product store management system with admin panel for managing products and categories.

## Features

### Frontend
- **Homepage**: Welcome page with navigation to products and categories
- **Products Page**: Display all products with prices and categories
- **Categories Page**: Show all product categories
- **Responsive Design**: Mobile-friendly Bootstrap-based interface

### Admin Panel
- **Products Management**: 
  - View all products in a DataTable
  - Add new products
  - Edit existing products
  - Delete products
  - View product details
- **Categories Management**:
  - View all categories
  - Add new categories
  - Edit existing categories
  - Delete categories
  - View category details with associated products

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- Modern web browser

## Installation

1. **Clone or download the project** to your web server directory

2. **Create the database**:
   - Open your MySQL client (phpMyAdmin, MySQL Workbench, etc.)
   - Import the `database.sql` file or run the SQL commands manually

3. **Configure database connection**:
   - Edit `includes/connection.php` and `admin/includes/connection.php`
   - Update the database credentials:
     ```php
     $connect = new PDO("mysql:host=localhost;dbname=product_store","root","");
     ```

4. **Set up your web server**:
   - Point your web server to the project directory
   - Ensure PHP is properly configured

5. **Access the application**:
   - Frontend: `http://your-domain/product_store/`
   - Admin Panel: `http://your-domain/product_store/admin/products/`

## Project Structure

```
product_store/
├── admin/
│   ├── categories/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── delete.php
│   │   └── details.php
│   ├── products/
│   │   ├── index.php
│   │   ├── create.php
│   │   ├── edit.php
│   │   ├── delete.php
│   │   └── details.php
│   └── includes/
│       ├── connection.php
│       ├── head.php
│       ├── sidebar.php
│       └── scripts.php
├── assets/
│   ├── css/
│   │   └── style.css
│   ├── js/
│   │   └── custom.js
│   └── images/
├── includes/
│   ├── connection.php
│   ├── head.php
│   ├── navbar.php
│   └── scripts.php
├── index.php
├── products.php
├── categories.php
├── database.sql
└── README.md
```

## Database Schema

### Categories Table
- `id` (Primary Key)
- `name` (VARCHAR)
- `description` (TEXT)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

### Products Table
- `id` (Primary Key)
- `name` (VARCHAR)
- `price` (DECIMAL)
- `description` (TEXT)
- `category_id` (Foreign Key to categories.id)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

## Usage

### Frontend Navigation
1. **Home**: Welcome page with quick access to products and categories
2. **Products**: Browse all available products with prices and descriptions
3. **Categories**: View all product categories

### Admin Panel
1. **Products Management**:
   - Click "Add New Product" to create products
   - Use the DataTable to view, edit, or delete products
   - Click "Details" to view complete product information

2. **Categories Management**:
   - Click "Add New Category" to create categories
   - Use the DataTable to view, edit, or delete categories
   - Click "Details" to see category information and associated products

## Customization

### Styling
- Edit `assets/css/style.css` to customize the appearance
- Modify Bootstrap classes in PHP files for layout changes

### Functionality
- Add new features by creating additional PHP files
- Extend the database schema for new fields
- Modify JavaScript in `assets/js/custom.js` for enhanced interactions

## Security Notes

- This is a basic implementation for demonstration purposes
- For production use, consider adding:
  - User authentication and authorization
  - Input validation and sanitization
  - CSRF protection
  - SQL injection prevention (already partially implemented with prepared statements)
  - File upload security for product images

## Troubleshooting

### Common Issues
1. **Database Connection Error**: Check database credentials in connection files
2. **Page Not Found**: Ensure web server is properly configured
3. **DataTable Not Working**: Check if jQuery and DataTables are loading correctly

### Support
For issues or questions, check the code comments or refer to the PHP and MySQL documentation.

## License

This project is open source and available under the MIT License. 