#!/usr/bin/perl -Tw
#
# Env by ZayDen
#
use CGI qw(:standard);
use strict;
use warnings qw(redefine);
# use ModPerl::Registry;
print "Content-type:image/html\n\n";
print "<br>\n";

my $str_IP=($ENV {'HTTP_X_REAL_IP'});
print "<b>IP: </b>$str_IP\n";
print "<br>\n";

my $str_COUNTRY=($ENV {'HTTP_GEOIP_COUNTRY_NAME'});
print "<b>COUNTRY: </b>$str_COUNTRY\n";
print "<br>\n";

my $str_CITY=($ENV {'HTTP_GEOIP_CITY'});
print "<b>CITY: </b>$str_CITY\n";
print "<br>\n";
print "<br>\n";

my $str_LATITUDE=($ENV {'HTTP_GEOIP_LATITUDE'});
print "<b>LATITUDE: </b>$str_LATITUDE\n";
print "<br>\n";

my $str_LONGITUDE=($ENV {'HTTP_GEOIP_LONGITUDE'});
print "<b>LONGITUDE: </b>$str_LONGITUDE\n";
print "<br>\n";

my $str_USER_AGENT=($ENV {'HTTP_USER_AGENT'});
print "<b>USER AGENT: </b>$str_USER_AGENT\n";
print "<br>\n";
