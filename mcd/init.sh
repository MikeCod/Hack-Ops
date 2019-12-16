echo "The repository will be created here, press enter to continue..."
read a
git init
git remote add origin https://github.com/MikeCod/Hack-Ops.git
git pull origin master
apt-get install net-tools
wget https://downloadsapachefriends.global.ssl.fastly.net/7.3.0/xampp-linux-x64-7.3.0-0-installer.run?from_af=true
chmod +x xampp-linux-x64-7.3.0-0-installer.run
./xampp-linux-x64-7.3.0-0-installer.run
/opt/lampp/lampp start
adduser user
echo "Installation finished, press enter to quit..."
read a