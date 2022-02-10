#!/usr/bin/env python3

import time
import random

timeout_start = time.time()
continue_reading = True

while continue_reading:
    time.sleep(random.randrange(0, 10))
    if time.time() > timeout_start + 5:
        print('TIMEOUT')
        continue_reading = False
    else:
        print(random.choice([
                    "Robert",
                    "Liam",
                    "Olivia",
                    "Noah",
                    "Emma",
                    "Oliver",
                    "Ava",
                    "William",
                    "Sophia",
                    "Elijah",
                    "Isabella",
                    "James",
                    "Charlotte",
                    "Benjamin",
                    "Amelia",
                    "Lucas",
                    "Mia",
                    "Mason",
                    "Harper",
                    "Ethan",
                    "Evelyn"
                    ]))
        continue_reading = False
