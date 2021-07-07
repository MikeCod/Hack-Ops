#include <unistd.h>
#include <sys/types.h>
#include <stdlib.h>
#include <stdio.h>

int main()
{
	int check = 0x04030201;
	char buf[44];

	fgets(buf,50,stdin);

	printf("\n[buf]: %s\n[check] %p\n", buf, check);

	if ((check != 0x04030201) && (check != 0xdeadbeef))
		printf ("\nYou are on the right way!\n");

	if (check == 0xdeadbeef)
	{
		printf("Congrats !\nOpening your shell...\n");
		setreuid(geteuid(), geteuid());
		system("/bin/bash");
		printf("Shell closed ! Bye.\n");
	}
	return 0;
}

