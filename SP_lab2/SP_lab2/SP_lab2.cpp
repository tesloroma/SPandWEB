// SP_lab2.cpp: ���������� ����� ����� ��� ����������� ����������.
//
#include "stdafx.h"
#include <direct.h>
#define MAX_LENGTH 100

void printDir();
void printFile();
bool changeWorkDir(char* workDir, char* changedDir, char* root);
void copyFile(char* workDir, char* changedDir, char* root);
void delFile(char* workDir, char* root);
void makeDir(char* workDir, char* root);

int main(int argc, char* argv[])
{
	setlocale(0, "rus");
	char command;
	char root[MAX_LENGTH];
	
	GetCurrentDirectoryA(MAX_LENGTH, root);
	char workDir[MAX_LENGTH], changedDir[MAX_LENGTH];
	strcpy(workDir, root);
	puts("�������� ��������:\n1->������� ������� ����������\n2->������ ��������\n3->���������� ����\n4->������� ����\n5->������� ����\n6->���������� � �����");

	for (;;)
	{
		scanf("%s", &command);
		switch (command)
		{
		case '1': changeWorkDir(workDir, changedDir, root); break;
		case '2': printDir(); break;
		case '3': copyFile(workDir, changedDir, root); break;
		case '4': delFile(root , workDir); break;
		case '5': makeDir(workDir, root); break;
		case '6': printFile(); break;
		case 'e': puts("�����!");  exit(0); break;
		default:
			puts("������������ ��������!");  break;
		}
	}
}


void printDir() {
	wchar_t dir_path[MAX_LENGTH] ;
	WIN32_FIND_DATA FindFileData;
	HANDLE hFind;
	LARGE_INTEGER FileSize;
	SYSTEMTIME st;
	puts("������� ����������: ");
	_tscanf(L"%s", &dir_path);
	hFind = FindFirstFile(dir_path, &FindFileData);
		if (hFind == INVALID_HANDLE_VALUE) {
			_tprintf(L"��� ����� ����������!");
		}
	else {
		puts("���������� ��������: ");
		do
		{
			_tprintf(L"%s", FindFileData.cFileName);
			if (FindFileData.dwFileAttributes & FILE_ATTRIBUTE_DIRECTORY)	
				printf(" <=DIR=>");
			else
			{
				printf(" <=FILE=> ");
				FileSize.HighPart = FindFileData.nFileSizeHigh;
				FileSize.LowPart = FindFileData.nFileSizeLow;
				_tprintf(L" <=Size: %ld=> ", FileSize);
			}
			FileTimeToSystemTime(&FindFileData.ftCreationTime, &st);
			_tprintf(L" <=Cteation date: %ld:%ld:%ld, %ld-%ld-%ld=>\n", st.wSecond, st.wMinute, st.wHour, st.wDay, st.wMonth, st.wYear);
		} 
		while (FindNextFile(hFind, &FindFileData) != 0);
		FindClose(hFind);
	}
}

void printFile() {
	wchar_t dir_path[MAX_LENGTH];
	wchar_t file_name[MAX_LENGTH];
	WIN32_FIND_DATA FindFileData;
	HANDLE hFind;
	LARGE_INTEGER FileSize;
	SYSTEMTIME st;
	puts("������� �������: ");
	_tscanf(L"%s", &dir_path);
	hFind = FindFirstFile(dir_path, &FindFileData);
	if (hFind == INVALID_HANDLE_VALUE) {
		_tprintf(L"��� ����� ����������!");
	}
	else {
		puts("������� ����: ");
		_tscanf(L"%s", &file_name);
		bool tmp = false;
		do
		{
			if (wcscmp(file_name, FindFileData.cFileName) == 0)
			{
				tmp = true;
				puts("���������� �����: ");
				_tprintf(L"%s", FindFileData.cFileName);
				if (FindFileData.dwFileAttributes & FILE_ATTRIBUTE_DIRECTORY)
					printf(" <=DIR=>");
				else
				{
					printf(" <=FILE=> ");
					FileSize.HighPart = FindFileData.nFileSizeHigh;
					FileSize.LowPart = FindFileData.nFileSizeLow;
					_tprintf(L" <=Size: %ld=> ", FileSize);
				}
				FileTimeToSystemTime(&FindFileData.ftCreationTime, &st);
				_tprintf(L" <=Cteation date: %ld:%ld:%ld, %ld-%ld-%ld=>\n", st.wSecond, st.wMinute, st.wHour, st.wDay, st.wMonth, st.wYear);
			}
		} while (FindNextFile(hFind, &FindFileData) != 0);

		if (!tmp) {
			puts("���� �� ������.");
		}
		FindClose(hFind);
	}
}

bool changeWorkDir(char* workDir, char* changedDir, char* root) {
	char str[MAX_LENGTH];

	printf("%s\n", root);

	puts("���� � ����� ����������: ");
	scanf("%s", changedDir);

	GetCurrentDirectoryA(MAX_LENGTH, workDir);
	strcpy(str, workDir);
	SetCurrentDirectoryA(changedDir);
	GetCurrentDirectoryA(MAX_LENGTH, workDir);
	if (strstr(workDir, root))
	{
		printf("%s\n", workDir);
		return true;
	}
	else {
		SetCurrentDirectoryA(str);
		GetCurrentDirectoryA(MAX_LENGTH, str);
		printf("������ ����!\n%s\n", str);
		return false;
	}
}

void copyFile(char* workDir, char* changedDir, char* root) {

	char str[MAX_LENGTH];

	printf("%s\n", root);

	puts("���� � ���� 1: ");
	scanf("%s", changedDir);
	char path_one[100];
	strcpy(path_one,changedDir);
	int a = strlen(changedDir);
	int b = a;
	int i = 0;
	bool strf = true;
	while ((changedDir[b] != '/') && (b >= 0))
	{
		if (changedDir[b - 1] == '/')
			strf = false;
		i++;
		b--;
	}

	char* splitter = "+";
	char* istr;
	char* arr[10];
	if(!strf)
	{ 
	changedDir[a - i] = '+';

	
	printf("%s\n", changedDir);
	int f = 0;
	istr = strtok(changedDir, splitter);
	while (istr != NULL)
	{
		arr[f] = istr;
		istr = strtok(NULL, splitter);
		f++;
	}
	char* f_path =  arr[0];
	char* f_file = arr[1];
	GetCurrentDirectoryA(MAX_LENGTH, workDir);
	strcpy(str, workDir);
	
	SetCurrentDirectoryA(f_path);
	}
	GetCurrentDirectoryA(MAX_LENGTH, workDir);
	printf("%s\n", workDir);
	if (strstr(workDir, root))
	{

		SetCurrentDirectoryA(str); //������� � ���� ����������
		GetCurrentDirectoryA(MAX_LENGTH, workDir);
		puts("���� � ���� 2: ");
		scanf("%s", changedDir);
		char path_two[100];
		strcpy(path_two, changedDir);
		a = strlen(changedDir);
		b = a;
		i = 0;
		bool strf = true;
		while (changedDir[b] != '/')
		{
			if (changedDir[b - 1] == '/')
				strf = false;
			i++;
			b--;
		}

		if (!strf)
		{
			changedDir[a - i] = '+';
			printf("%s\n", changedDir);
			int f = 0;
			istr = strtok(changedDir, splitter);
			while (istr != NULL)
			{
				arr[f] = istr;
				istr = strtok(NULL, splitter);
				f++;
			}
			char* s_path = arr[0];
			GetCurrentDirectoryA(MAX_LENGTH, workDir);
			strcpy(str, workDir);
			SetCurrentDirectoryA(s_path);
		}

		GetCurrentDirectoryA(MAX_LENGTH, workDir);
		if (strstr(workDir, root))
		{
			SetCurrentDirectoryA(str);
			GetCurrentDirectoryA(MAX_LENGTH, workDir);
			printf("%s\n", workDir);
			printf("��� ������ ����: %s\n", path_one);
			printf("��� ������ ����: %s\n", path_two);
			printf("%s\n", workDir);
			if (CopyFileA(path_one, path_two, true)) {
				puts("������� �����������!");
			}
			else {
				puts("������ �����������!");
			}
		}
		else {
			printf("������ ����!\n");
		}
	}
	else {
		SetCurrentDirectoryA(str);
		GetCurrentDirectoryA(MAX_LENGTH, str);
		printf("������ ����!\n%s\n", str);
		
	}
}

void delFile(char* root, char* workDir) {
	char  changedDir[MAX_LENGTH];
	char str[MAX_LENGTH];

	printf("%s\n", root);

	puts("���� � ���������� ���� : ");
	scanf("%s", &changedDir);
	char path_one[100];
	strcpy(path_one, changedDir);
	int a = strlen(changedDir);
	int b = a;
	int i = 0;
	bool strf = true;
	while ((changedDir[b] != '/') && (b >= 0))
	{
		if (changedDir[b - 1] == '/')
			strf = false;
		i++;
		b--;
	}

	char* splitter = "+";
	char* istr;
	char* arr[10];
	if (!strf)
	{
		changedDir[a - i] = '+';
		printf("%s\n", changedDir);
		int f = 0;
		istr = strtok(changedDir, splitter);
		while (istr != NULL)
		{
			arr[f] = istr;
			istr = strtok(NULL, splitter);
			f++;
		}
		char* f_path = arr[0];
		GetCurrentDirectoryA(MAX_LENGTH, workDir);
		strcpy(str, workDir);

		SetCurrentDirectoryA(f_path);
	}
	GetCurrentDirectoryA(MAX_LENGTH, workDir);
	printf("%s\n", workDir);
	if (strstr(workDir, root))
	{
		if (DeleteFileA(changedDir))
		{
			printf("���� ������� ������\n");
		}
		else if (!rmdir(changedDir)) {
			printf("����������  ������� �������\n");
		}
		else {
			printf("�� �������!");
		}
	}
	else {
		printf("��� ����\n");
	}
}

void makeDir(char* workDir, char* root) {
	char  changedDir[MAX_LENGTH], str[MAX_LENGTH];//���� � ������������ ����� � ��������� ���������� ��� ��� �������� ��� ���������
	puts("���� ������������ �����: ");
	scanf("%s", &changedDir);
	char* f_name; 
	char* f_path;
	int a = strlen(changedDir);
	int b = a;
	int i = 0;
	bool strf = true;
	while ((changedDir[b] != '/') && (b >= 0))//��������� ������ �� ���� � ����
	{
		if (changedDir[b - 1] == '/')
			strf = false;
		i++;
		b--;
	}

	char* splitter = "+";//��������� ������ �� ���� � ����
	char* istr;
	char* arr[10];
	if (!strf)
	{
		changedDir[a - i] = '+';
		printf("%s\n", changedDir);
		int f = 0;
		istr = strtok(changedDir, splitter);
		while (istr != NULL)
		{
			arr[f] = istr;
			istr = strtok(NULL, splitter);
			f++;
		}
		f_path = arr[0];
		f_name = arr[1];
		GetCurrentDirectoryA(MAX_LENGTH, workDir);//�������� �� ��������� � ������� �����
		strcpy(str, workDir);
		SetCurrentDirectoryA(f_path);
	}
	else {
		f_name = changedDir;
	}

	GetCurrentDirectoryA(MAX_LENGTH, workDir);
	printf("%s\n", workDir);
	if (strstr(workDir, root))
	{
		SetCurrentDirectoryA(str);//������������ ������� � ������� �����, ���� �� ��������� �������
		DWORD dwTemp;
		HANDLE hFile = CreateFileA(f_name, GENERIC_WRITE, 0, NULL,
			CREATE_ALWAYS, FILE_ATTRIBUTE_NORMAL, NULL);
		if (INVALID_HANDLE_VALUE == hFile) {
			puts("������ ��������.");
			return;
		}
	}
	else {
		puts("��� ����.");
	}
}

