import csv
import pprint
import time
import re

i = 0

with open('output.php', 'a') as e:
  print('<?php', file=e)
  print('', file=e)
  print('use Illuminate\Database\Seeder;', file=e)
  print('', file=e)
  print('class UranaisTableSeeder extends Seeder', file=e)
  print('{', file=e)
  print('   /**', file=e)
  print('   * Run the database seeds.', file=e)
  print('   *', file=e)
  print('   * @return void', file=e)
  print('   */', file=e)
  print('   public function run()', file=e)
  print('   {', file=e)
  print("       DB::table('uranais')->insert([", file=e)
  e.close()

with open('export13.csv') as f:
  reader = csv.reader(f)
  for row in reader:
    if i != 0:
      with open('output.php', 'a') as e:
        print("         [", file=e)
        print("           'title' => " + "'" + row[0] + "',", file=e)
        print("           'text' => " + "'" + row[1] + "',", file=e)
        print("           'level' => " + "'" + row[2] + "',", file=e)
        print("         ],", file=e)
        time.sleep(0.08)
        print("出力完了！！")
        e.close()
    i = i + 1
  f.close()


with open('output.php', 'a') as e:
  print("       ]);", file=e)
  print('   }', file=e)
  print('}', file=e)
  e.close()