#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <malloc.h>
#include <unistd.h> 

int main(int argc, char *argv[]){
	char **buffer = NULL;
	char entry[0xffff];
	
	scanf("%s", entry);
	
	unsigned short length = strlen(entry) * sizeof(char*);
	buffer = malloc(length);
	
	printf("strlen(entry) = %u\nmalloc_usable_size(buffer) = %ld\n", strlen(entry), malloc_usable_size(buffer));
	
	if(malloc_usable_size(buffer) < (strlen(entry) * sizeof(char*)))
	{
		printf("Congrats !\n");
		setreuid(geteuid(), geteuid());
                system("/bin/bash");
	}
	free(buffer);
	
	return 0;
}
