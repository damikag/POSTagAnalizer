import time
import sys

start_time = time.time()

try:
    input_file=str(sys.argv[1])
    working_dir=""

    if len(sys.argv)>=3:
        working_dir=str(sys.argv[2])
except:
    print "Command line argument error"
    sys.exit()

junk_lines=[]
formated_lines=[]

print "\nReading........"

with open(working_dir+input_file,'r') as file: 
    line_number=0 

    for line in file:
        
        line_number+=1
        
        if line=='\n':
            continue
        if len(line.strip().split())==2:
            formated_lines.append(line)           
        else:
            
            junk_lines.append([line_number,line])

print "Finished reading"
print("--- %s seconds ---\n" % (time.time() - start_time))


if len(junk_lines):
    print "Merging stopped."
    print str(len(junk_lines))+" line/lines is/are out of format [word][space][tag]"
    print "Writing to junk.txt"
    
    junkFile=open(working_dir+'junk.txt',"w")

    for line in junk_lines:
        junkFile.write(str(line[0])+':-')
        junkFile.write(line[1])

    junkFile.close()
    
    start_time=time.time()
    print "Finished writing"
    print("--- %s seconds ---" % (time.time() - start_time))

    print "Please correct the format mismatches and re-merge"

else:
    print "Merging to Corpus.txt\n Please wait."

    start_time=time.time()

    corpusFile=open(working_dir+"Corpus.txt","a")
    for line in formated_lines:
        corpusFile.write(line)
    corpusFile.close()

    start_time=time.time()
    print "Finished writing"
    print("--- %s seconds ---\n" % (time.time() - start_time))

    print "Merging successfully completed."
