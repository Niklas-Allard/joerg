input = "Folge 101 233 1"
output = ""

first_num = False
allowed_number = "0123456789"

for char in input:
    if char in allowed_number:
        if not first_num:
            if char == "0":
                continue
            output += char
            first_num = True
        else:
            output += char
    else:
        output += char
        first_num = False