import sys
tokens = sys.stdin.read().split()

if len(tokens) < 3:
    sys.exit(0)

h = int(tokens[0])
m = int(tokens[1])
s = int(tokens[2])

s += 1

if s == 60:
    s = 0
    m += 1
    
    if m == 60:
        m = 0
        h += 1
        
        if h == 24:
            h = 0
print(f"{h:02d}:{m:02d}:{s:02d}")