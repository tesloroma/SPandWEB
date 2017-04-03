// SP_lab2.cpp: определяет точку входа для консольного приложения.
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
	puts("Выберите комманду:\n1->Сменить рабочую директорию\n2->Печать каталога\n3->Копировать файл\n4->Удалить файл\n5->Создать файл\n6->Информация о файле");

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
		case 'e': puts("Выход!");  exit(0); break;
		default:
			puts("Некоррентная комманда!");  break;
		}
	}
}


void printDir() {
	wchar_t dir_path[MAX_LENGTH] ;
	WIN32_FIND_DATA FindFileData;
	HANDLE hFind;
	LARGE_INTEGER FileSize;
	SYSTEMTIME st;
	puts("Введите директорию: ");
	_tscanf(L"%s", &dir_path);
	hFind = FindFirstFile(dir_path, &FindFileData);
		if (hFind == INVALID_HANDLE_VALUE) {
			_tprintf(L"Нет такой директории!");
		}
	else {
		puts("Содержимое каталога: ");
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
	puts("Введите каталог: ");
	_tscanf(L"%s", &dir_path);
	hFind = FindFirstFile(dir_path, &FindFileData);
	if (hFind == INVALID_HANDLE_VALUE) {
		_tprintf(L"Нет такой директории!");
	}
	else {
		puts("Введите файл: ");
		_tscanf(L"%s", &file_name);
		bool tmp = false;
		do
		{
			if (wcscmp(file_name, FindFileData.cFileName) == 0)
			{
				tmp = true;
				puts("Содержимое файла: ");
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
			puts("Файл не найден.");
		}
		FindClose(hFind);
	}
}

bool changeWorkDir(char* workDir, char* changedDir, char* root) {
	char str[MAX_LENGTH];

	printf("%s\n", root);

	puts("Путь к новой директории: ");
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
		printf("Нельзя выше!\n%s\n", str);
		return false;
	}
}

void copyFile(char* workDir, char* changedDir, char* root) {

	char str[MAX_LENGTH];

	printf("%s\n", root);

	puts("Путь к фалу 1: ");
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

		SetCurrentDirectoryA(str); //Обратно в нашу директорию
		GetCurrentDirectoryA(MAX_LENGTH, workDir);
		puts("Путь к фалу 2: ");
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
			printf("Это первый файл: %s\n", path_one);
			printf("Это второй файл: %s\n", path_two);
			printf("%s\n", workDir);
			if (CopyFileA(path_one, path_two, true)) {
				puts("Успешно скопировано!");
			}
			else {
				puts("Ошибка копирования!");
			}
		}
		else {
			printf("Нельзя выше!\n");
		}
	}
	else {
		SetCurrentDirectoryA(str);
		GetCurrentDirectoryA(MAX_LENGTH, str);
		printf("Нельзя выше!\n%s\n", str);
		
	}
}

void delFile(char* root, char* workDir) {
	char  changedDir[MAX_LENGTH];
	char str[MAX_LENGTH];

	printf("%s\n", root);

	puts("Путь к удаляемому фалу : ");
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
			printf("Файл успешно удален\n");
		}
		else if (!rmdir(changedDir)) {
			printf("Директория  успешно удалена\n");
		}
		else {
			printf("Не найдено!");
		}
	}
	else {
		printf("Вне прав\n");
	}
}

void makeDir(char* workDir, char* root) {
	char  changedDir[MAX_LENGTH], str[MAX_LENGTH];//Путь к создаваемому файлу и временная переменная для его хранения при изменении
	puts("Путь создаваемого файла: ");
	scanf("%s", &changedDir);
	char* f_name; 
	char* f_path;
	int a = strlen(changedDir);
	int b = a;
	int i = 0;
	bool strf = true;
	while ((changedDir[b] != '/') && (b >= 0))//разбиение строки на путь и файл
	{
		if (changedDir[b - 1] == '/')
			strf = false;
		i++;
		b--;
	}

	char* splitter = "+";//разбиение строки на путь и файл
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
		GetCurrentDirectoryA(MAX_LENGTH, workDir);//Проверка на вхождение в каталог корня
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
		SetCurrentDirectoryA(str);//Перехождение обратно в каталог корня, если мы соблюдаем условие
		DWORD dwTemp;
		HANDLE hFile = CreateFileA(f_name, GENERIC_WRITE, 0, NULL,
			CREATE_ALWAYS, FILE_ATTRIBUTE_NORMAL, NULL);
		if (INVALID_HANDLE_VALUE == hFile) {
			puts("Ошибка создания.");
			return;
		}
	}
	else {
		puts("Вне прав.");
	}
}

