<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string("name");
            $table->string("website")->nullable();
            $table->string("logo")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->string("zip")->nullable();
            $table->string("country")->nullable();
            $table->text("description")->nullable();
            $table->enum("industry",["accounting","advertising","agriculture","architecture","automotive","banking","biotechnology","business","construction","education","engineering","entertainment","finance","food","government","healthcare","hospitality","human-resources","information-technology","insurance","legal","manufacturing","marketing","media","non-profit","pharmaceutical","public-relations","real-estate","retail","science","telecommunications","transportation","travel","other"])->default("other");
            $table->enum("size",["1-10","11-50","51-200","201-500","501-1000","1001-5000","5001-10000","10001+"])->default("1-10");
            $table->enum("founded",["2024","2023","2022","2021","2020","2019","2018","2017","2016","2015","2014","2013","2012","2011","2010","2009","2008","2007","2006","2005","2004","2003","2002","2001","2000","1999","1998","1997","1996","1995","1994","1993","1992","1991","1990","1989","1988","1987","1986","1985","1984","1983","1982","1981","1980","1979","1978","1977","1976","1975","1974","1973","1972","1971","1970","1969","1968","1967","1966","1965","1964","1963","1962","1961","1960","1959","1958","1957","1956","1955","1954","1953","1952","1951","1950","1949","1948","1947","1946","1945","1944","1943","1942","1941","1940","1939","1938","1937","1936","1935","1934","1933","1932","1931","1930","1929","1928","1927","1926","1925","1924","1923","1922","1921","1920","1919","1918","1917","1916","1915","1914","1913","1912","1911","1910","1909","1908","1907","1906","1905","1904","1903","1902","1901","1900","1800-1899","1700-1799","1600-1699","1500-1599","1400-1499","1300-1399","1200-1299","1100-1199","1000-1099","900-999","800-899","700-799","600-699","500-599","400-499","300-399","200-299","100-199","1-99"])->default("2024");
            $table->enum("type",["public","private","government","non-profit","other"])->default("other");
            $table->enum("revenue",["0-1M","1-10M","10-50M","50-100M","100-500M","500-1B","1-10B","10B+"])->default("0-1M");
            $table->enum("ownership",["sole-proprietorship","partnership","corporation","non-profit","other"])->default("sole-proprietorship");
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
