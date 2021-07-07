#include <iostream>
#include <cstdlib>
#include <ctime>
#define cimg_display 0
#include "CImg-2.9.8_pre052421/CImg.h"

using namespace cimg_library;
using namespace std;

string get_random_string(size_t length) {
	string buffer;
	for(int i = 0; i < length ; ++i)
		buffer += char((rand() % 26) + 65);
	return buffer;
}

int main() {
	srand(time(NULL));

	// Create 640x480 image
	CImg<unsigned char> image(640,480,1,3);

	// Fill with white
	cimg_forXY(image,x,y) {
		image(x,y,0,0)=255;
		image(x,y,0,1)=255;
		image(x,y,0,2)=255;
	}

	// background
	unsigned char background[]    = {255,   255, 255 };
	unsigned char black[]	= {0,	0,	0};
	// Draw black text on cyan
	image.draw_text(30,60,get_random_string(12).c_str(),black,background,1,64);

	// Save result image as NetPBM PNM - no libraries required
	image.save_pnm("/home/ch-cc-2/captcha.bmp");
}
