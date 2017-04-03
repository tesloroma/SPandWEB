// SP_lab2_part2.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"

struct  header {
	int num;
	int count_view;
	char text[80];
};

int _tmain(int argc, _TCHAR* argv[])
{
	setlocale(0, "rus");

	void checkError(DWORD dw);
	DWORD dw;
	DWORD lpDwNumOfBytes;
	HANDLE hFile = CreateFile(L"test.txt", GENERIC_ALL, FILE_SHARE_READ, NULL, CREATE_ALWAYS, NULL, 0);
	if (hFile == INVALID_HANDLE_VALUE)
	{
		dw = GetLastError();
		checkError(dw);
		return 0;
	}
	else {
		puts("ФАЙЛ УСПЕШНО СОЗДАН!");
		puts("Введите число структур: ");
		int count_struct;
		scanf("%d", &count_struct);
		const int size = 6;
		header* head;
		head = (header*)malloc(sizeof(header) * count_struct);
		memset(head, 0, sizeof(head));
		for (int i = 0; i < count_struct; i++) {
			head[i].num = i + 1;
			head[i].count_view = 10;
			strcpy(head[i].text, "HELLO!");
			WriteFile(hFile, &head[i], sizeof(head[i]), &lpDwNumOfBytes, NULL);
		}

		for (int i = 0; i < count_struct; i++)
		{
			printf("%s\n", head[i].text);
		}

		CloseHandle(hFile);
		HANDLE hFile = CreateFile(L"test.txt", GENERIC_READ, FILE_SHARE_READ, NULL, OPEN_EXISTING, NULL, 0);
	    header hed[size];
		for (int i = 0; i < size; i++) {
			if (ReadFile(hFile, &hed, sizeof(&hed), &lpDwNumOfBytes, NULL)) {
				printf("данные: %d\n", hed[i].num);
			}
		}
		
		
	/*	if (lpDwNumOfBytes > 0)
			printf("%s\n", ar);*/
		return 0;
	}
  
}

void checkError(DWORD dw) {
	LPVOID lpMsg;
	FormatMessage(FORMAT_MESSAGE_ALLOCATE_BUFFER |
		FORMAT_MESSAGE_FROM_SYSTEM |
		FORMAT_MESSAGE_IGNORE_INSERTS,
		NULL,
		dw,
		MAKELANGID(LANG_NEUTRAL, SUBLANG_DEFAULT),
		(LPTSTR)&lpMsg,
		0,
		NULL);
	_tprintf(TEXT("%s"), lpMsg);
}
