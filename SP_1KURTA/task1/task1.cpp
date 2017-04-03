// task1.cpp: ���������� ����� ����� ��� ����������� ����������.
//

#include "stdafx.h"
#include "locale"

void Error();
void ErrorMessage(HRESULT hResult = NULL);
void SystemInfo();

int main(int argc, char** argv)
{
	setlocale(LC_ALL, "Russian");
	if (argc != 2)
	{
		printf("���������� ������� ��� ���������!\n");
	}
	else if (!strcmp(argv[1], "-e"))
	{
		Error();
		ErrorMessage();
	}
	else if (!strcmp(argv[1], "-s"))
	{
		SystemInfo();
	}
	else
	{
		printf("���������� ������� ��� ���������!\n");
	}
	return 0;
}

void Error()
{
	LocalAlloc(LPTR, 0xffffffff);
}

void ErrorMessage(HRESULT hResult)
{
	if (hResult == NULL)
	{
		hResult = GetLastError();
	}

	LPTSTR errorText = NULL;

	FormatMessage(
		FORMAT_MESSAGE_FROM_SYSTEM | FORMAT_MESSAGE_ALLOCATE_BUFFER | FORMAT_MESSAGE_IGNORE_INSERTS,
		NULL,
		hResult,
		MAKELANGID(LANG_NEUTRAL, SUBLANG_DEFAULT),
		(LPTSTR)&errorText,
		0,
		NULL);

	if (NULL != errorText)
	{
		wprintf(L"%s", errorText);
		LocalFree(errorText);
	}
}

void SystemInfo()
{
	wprintf(L"���������� � ����������:\n");
	SYSTEM_INFO system;
	GetNativeSystemInfo(&system);

	TCHAR mass[7];
	if (system.wProcessorArchitecture == PROCESSOR_ARCHITECTURE_AMD64) {
		lstrcpy(mass, L"x64");
	}
	else if (system.wProcessorArchitecture == PROCESSOR_ARCHITECTURE_ARM) {
		lstrcpy(mass, L"ARM");
	}
	else if (system.wProcessorArchitecture == PROCESSOR_ARCHITECTURE_INTEL) {
		lstrcpy(mass, L"x86");
	}
	else{
		lstrcpy(mass, L"Unknown");
	}
		


	wprintf(L"    ����������� ����������: %s\n", mass);
	wprintf(L"    Processor level: %u\n", system.wProcessorLevel);
	wprintf(L"    Page size: %u\n", system.dwPageSize);
	wprintf(L"    ���������� ����: %u\n\n", system.dwNumberOfProcessors);



	wprintf(L"���������� � ������:\n");
	MEMORYSTATUSEX MyStat;
	MyStat.dwLength = sizeof(MEMORYSTATUSEX);
	GlobalMemoryStatusEx(&MyStat);


	wprintf(L"    ������(%%): %u%%\n", MyStat.dwMemoryLoad);
	wprintf(L"    �������������: %llu bytes, %llu MB \n", MyStat.ullAvailPhys, MyStat.ullAvailPhys / 0x100000);
	wprintf(L"    �����: %llu bytes, %llu MB \n", MyStat.ullTotalPhys, MyStat.ullTotalPhys / 0x100000);
}