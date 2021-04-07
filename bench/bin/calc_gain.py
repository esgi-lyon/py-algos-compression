#/bin/python3

# calc global gain on hardcoded batch sizes
#                        XL L  M S XS
# Example ./calc_gain.py 50 29 6 4 3
#
import sys

argv = sys.argv[1:];

xl  = int(argv[0]);
l   = int(argv[1]);
m   = int(argv[2]);
s   = int(argv[3]);
xs  = int(argv[4]);

result = (75 * xl) + (100 * l) + (180 * m) + (300 * s) + (800 * xs);

print(result);
