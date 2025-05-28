[testFile.csv](https://github.com/user-attachments/files/20495742/testFile.csv)





🚀 Step-by-Step: Deployment Guide

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
