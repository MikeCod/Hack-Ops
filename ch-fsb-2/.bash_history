./ch
./ch %s
./ch %c
./ch %c%c
./ch $(python -c "print '%08x.'*8")
./ch $(python -c "print '%09x.'*8")
./ch $(python -c "print '%016x.'*8")
exit
cd ../ch-fsb-2
ls -la
cat ch.c
./ch $(python -c "print 'A'")
./ch $(python -c "print '%s'")
./ch $(python -c "print '%08x'")
./ch $(python -c "print '%08x'*8")
./ch $(python -c "print '%08x.'*8")
cd ..
exit
cat ch.c
cd ch-fsb-2
cat ch.c
./ch %s
./ch $(python -c "print '%08x.'")
./ch $(python -c "print '%08x.'*8")
cd ..
exit
