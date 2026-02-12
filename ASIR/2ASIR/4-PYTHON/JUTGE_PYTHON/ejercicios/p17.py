import sys

tokens = sys.stdin.read().split()

if len(tokens) >= 2:
    x = int(tokens[0])
    y = int(tokens[1])
    start = max(x, y)
    end = min(x, y)
    
    for i in range(start, end - 1, -1):
        print(i)