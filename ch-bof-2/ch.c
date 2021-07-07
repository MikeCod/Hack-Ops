#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <sys/types.h>
#include <unistd.h>

/*
 * gcc -o ch ch.c -fno-stack-protector -no-pie -Wl,-z,relro,-z,now,-z,noexecstack 
 * /usr/share/metasploit-framework/tools/exploit/pattern_create.rb -l <length>
 * /usr/share/metasploit-framework/tools/exploit/pattern_offset.rb -q <code returned>
 */
void secret_function(){
	printf("Congrats !\nOpening your shell...\n");
	char *argv[] = { "/bin/bash", "-p", NULL };
	execve(argv[0], argv, NULL);
	printf("Shell closed ! Bye.\n");
}

int main(int argc, char **argv){

	char buffer[256];

	scanf("%s", buffer);
	printf("Hello %s\n", buffer);

	return 0;
}

