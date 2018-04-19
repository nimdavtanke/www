#!/usr/bin/perl -Tw
#
# Graphcounter by ZayDen
#
use CGI qw(:standard);
use strict;
use warnings qw(redefine);
use ModPerl::Registry;
use DateTime; #для времени
my $dt = DateTime->now();

my $file="/var/www/html/fw.nimda.pro/count.txt";
my $dig_num=6;

#Указываем путь к картинкам.
my $path="/pic";
my $dig1="1.jpg";
my $dig2="2.jpg";
my $dig3="3.jpg";
my $dig4="4.jpg";
my $dig5="5.jpg";
my $dig6="6.jpg";
my $dig7="7.jpg";
my $dig8="8.jpg";
my $dig9="9.jpg";
my $dig0="0.jpg";

#Записываем показания счетчика в файл.
open (STAT,"$file");
my $count=<STAT>;
close (STAT);

$count++;

open (STAT,">$file");
my @digits=split (//,$count);
my $number=@digits;

if ($number < $dig_num) {
my $diff=$dig_num-$number;
$count="0"x$diff.$count;
} else {
my $count=$count;
}
print STAT $count;
close (STAT);

open (STAT,"$file");
my $line=<STAT>;              #Читаем содержимое файла в строку.
my @numbers=split (//,$line); #Разбиваем строку на символы.
close (STAT);

print "Content-type:image/html\n\n";
print "<b>COUNTER:  </b>";
foreach my $dig (@numbers) {
$dig =~ s/1/<img src=$path\/$dig1>/g;
$dig =~ s/2/<img src=$path\/$dig2>/g;
$dig =~ s/3/<img src=$path\/$dig3>/g;
$dig =~ s/4/<img src=$path\/$dig4>/g;
$dig =~ s/5/<img src=$path\/$dig5>/g;
$dig =~ s/6/<img src=$path\/$dig6>/g;
$dig =~ s/7/<img src=$path\/$dig7>/g;
$dig =~ s/8/<img src=$path\/$dig8>/g;
$dig =~ s/9/<img src=$path\/$dig9>/g;
$dig =~ s/0/<img src=$path\/$dig0>/g;
print $dig;
}
print "<br>\n";

#Пишем логи
open (DATA,">>/var/www/html/fw.nimda.pro/count.log");
my $str_COUNTRY=($ENV {'HTTP_GEOIP_COUNTRY_NAME'});
my $str_CITY=($ENV {'HTTP_GEOIP_CITY'});
my $str_IP=($ENV {'HTTP_X_REAL_IP'});
my $str_USER_AGENT=($ENV {'HTTP_USER_AGENT'});
my $string_log=join (' ',"Date:",scalar localtime,"IP:",$str_IP,"Country:",$str_COUNTRY,"City:",$str_CITY,"User_agent:",$str_USER_AGENT);
print DATA "$string_log\n";
close (DATA);

#Пишем историю для вывода на сайте
open (HISTORY,">>/var/www/html/fw.nimda.pro/history.log");
my $string_history=join (' ',$dt->hms,"IP:",$str_IP,"Country:",$str_COUNTRY,"City:",$str_CITY);
print HISTORY "$string_history\n";
close (HISTORY);
