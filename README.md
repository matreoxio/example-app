Test File - 

[testFile.csv](https://github.com/user-attachments/files/20495742/testFile.csv)





<h3>🚀 Step-by-Step: Deployment Guide</h3>

✅ 1. Clone the Repository

git clone https://github.com/matreoxio/example-app.git

cd example-app

✅ 2. Install PHP Dependencies

Make sure PHP 8.1+ and Composer are installed.

Run - 
composer install

✅ 3. Set Up Environment File

Copy .env.example to .env:

Edit .env and configure the database connection

✅ 4. Generate Application Key

php artisan key:generate

✅ 5. Run Migrations and Seeders

php artisan migrate --seed

✅ 6. Serve the Application Locally

php artisan serve

Your API endpoints will be available at:

http://127.0.0.1:8000/api/upload (POST — for CSV file upload)

http://127.0.0.1:8000/api/get (GET — retrieve shipment data with status names)

✅ 7. Test the CSV Upload

![image](https://github.com/user-attachments/assets/d214afa4-eeed-4080-bfa5-7e1d66413612)


Use Postman or curl:

curl -X POST http://127.0.0.1:8000/api/upload \

  -F "file=@path/to/your/file.csv"
  
CSV file should have headers like:

shipment_id, origin, destination, weight, status

123, London, Paris, 12.5, Pending

The status field will be matched against names in your statuses table and converted to status_id.

✅ 8. Check Output

You can retrieve data using:

curl http://127.0.0.1:8000/api/get

Or open it in browser: http://127.0.0.1:8000/api/get

This should return all shipments with their status name (not ID).

<h3>🧱 Architecture & Highlights</h3>

📂 Project Structure

Laravel 12 backend application following MVC architecture.

Clean separation of concerns using:

Controllers for request handling

Services for business logic

Models for database interaction

Migrations and Seeders for schema and data setup

📦 Key Features

CSV Upload API (POST /api/upload)

Accepts CSV files with columns: shipment_id, origin, destination, weight, status

Validates file format and contents

Maps human-readable status (e.g., Delivered) to foreign key (status_id)

Inserts clean, validated data into the shipments table

Data Retrieval API (GET /api/get)

Returns all shipment records

Replaces status_id with corresponding status.name via Eloquent relationship

JSON formatted for easy frontend integration

🧪 Validations

Headers must match exactly: shipment_id, origin, destination, weight, status

Required fields validated per row

status names matched against the seeded statuses table

Prevents incomplete or corrupt data from being inserted

🔐 Security

File size limited to 2MB

Only .csv and .txt MIME types are accepted

Uses Laravel’s built-in validation system for safe file handling

🔄 Relationships

Shipment belongsTo Status

Eager loading used to avoid N+1 queries (Shipment::with('status'))
