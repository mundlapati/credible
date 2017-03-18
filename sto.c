#include <stdio.h>
#include <strings.h>

static char arr[] = "abcdefghijklmnopqrstuvwxyz";
static char ARR[] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

int main(int a, char** v)
{
	if (a != 2) { printf("usage: %s string\n", v[0]); return 0; }

	int i = 0;
	int j = 0;
	int k = 0;

	int t = strlen(v[1]);

	for (j=0; j<26; j++)
		for (i=0; i<t; i++)
		if (v[1][i] == arr[j] || v[1][i] == ARR[j])
		{
			k = k+j+1;
			continue;
		}

	printf("%d\n", k);
	return 0;
}
