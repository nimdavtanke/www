#!/usr/bin/perl
#
# Env by ZayDen
#
use CGI qw(:standard);
use strict;
use warnings qw(redefine);

print "Content-type:image/html\n\n";
print "<br>\n";

my @history = reverse(`/usr/bin/tail -n 10 /var/www/html/fw.nimda.pro/history.log`);
foreach my $line (@history)
{
    print $line;
    print "<br />";
}

1;
