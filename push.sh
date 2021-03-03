cd /var/www/html/dave/
git add .
version=`cat /var/www/html/dave/twa_version.conf`
version=$(echo "scale=2; $version+0.01" | bc)
git commit -m "Version `echo "$version"`"
git push
