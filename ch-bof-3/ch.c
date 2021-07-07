#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[]) {
	char buffer[512];
	setreuid(geteuid(), geteuid());
	strcpy(buffer, argv[1]);
	return 0;
}
