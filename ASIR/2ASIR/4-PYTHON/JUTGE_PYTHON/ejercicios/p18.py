import sys

tokens = sys.stdin.read().split()

if len(tokens) >= 2:
    a = int(tokens[0])
    b = int(tokens[1])
    if a <= b:
        print(*range(a, b + 1), sep=',')
    else:
        print()