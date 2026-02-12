import sys

tokens = sys.stdin.read().split()


if not tokens:
    sys.exit(0)

year = int(tokens[0])

if (year % 4 == 0 and year % 100 != 0) or (year % 400 == 0):
    print("YES")
else:
    print("NO")