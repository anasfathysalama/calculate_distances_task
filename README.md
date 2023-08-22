### Laravel Application To Calculate Distances

---

#### Installation

requirements : 
 - PHP 8.1

after clone this repo, you should run this commands in your terminal inside project directory

```
composer install
```

then copy `` .env.example `` file and rename to `` .env `` and generate application key by run

```
php artisan key:generate 
```

after that you need to define your ``` POSITION_STACK_API_KEY ``` and ``` POSITION_STACK_API_URL ``` in ``` .env ```
file,
they have values by default and can find in ``` config/position_stack.php ``` file inside config folder.

run ``` php artisan storage:link ``` to link storage to public folder

run ``` php artisan calc:distances ``` to calculate the distances and store it inside CSV file.

if every thing is configured and run successfully you will be able to see in your console like that

```
1,3,026.37 km,Eastern Enterprise B.V.,Deldenerstraat 70, 7551AH Hengelo, The Netherlands
3,3,036.98 km,Adchieve Rotterdam,Weena 505, 3013 AL Rotterdam, The Netherlands
4,3,503.61 km,Sherlock Holmes,221B Baker St., London, United Kingdom
7,3,644.33 km,The Pope,Saint Martha House, 00120 Citta del Vaticano, Vatican City
2,3,850.60 km,Eastern Enterprise,46/1 Office no 1 Ground Floor , Dada House , Inside dada silk mills compound, Udhana Main Rd, near Chhaydo Hospital, Surat, 394210, India
6,8,480.29 km,The Empire State Building,350 Fifth Avenue, New York City, NY 10118
5,8,783.97 km,The White House,1600 Pennsylvania Avenue, Washington, D.C., USA
8,10,379.86 km,Neverland,5225 Figueroa Mountain Road, Los Olivos, Calif. 93441, USA
Distances calculated and saved in distances.csv in path: your_project_path\storage\app/public/distances.csv
```

run ``` php artisan serve ``` to start application server

visit http://127.0.0.1:8000/get-distances and you will see the same results.

