#include <stdio.h>
#include <stdlib.h>
#ifdef _WIN32
#include <Windows.h>
#else
#include <unistd.h>
#endif

int create();
int copy();

int main(int argc, char const *argv[])
{
	copy();
	usleep(50000);
	remove("flag");
	return 0;
}

// DONE : create flag and copi/paste flag-0 into flag 

int copy()
{
	FILE* doc1 = NULL;
	FILE* doc2 = NULL;
	char buffer[65] = "";

	doc1 = fopen("flag", "w");
	if (doc1 == NULL)
	{
		printf("challenge error : can't create doc flag");
		exit(1);
	}
	doc2 = fopen("flag-0", "r");
	if (doc2 == NULL)
	{
		printf("callenge error : can't read doc flag-O");
		fclose(doc1);
		exit(1);
	}
	fgets(buffer, 65, doc2);
	fclose(doc2);
	fputs(buffer, doc1);
	fclose(doc1);
}
