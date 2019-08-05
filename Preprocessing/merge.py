#!/usr/bin/env python
import time
import sys

start_time = time.time()

try:
    input_file=str(sys.argv[1])
    save_to=""
    input_file_name=str(sys.argv[2])

    if len(sys.argv)>=4:
        save_to=str(sys.argv[3])
except:
    print "Command line argument error"
    sys.exit()

junk_lines=[]
formated_lines=[]
# input_file_name=input_file.strip().split('/')[-1]
# input_file_name=input_file_name.replace(' ','_')

# print "\nReading........"

with open(input_file,'r') as file: 
    line_number=0 

    for line in file:
        
        line_number+=1
        
        if line=='\n':
            continue
        if len(line.strip().split())==2:
            formated_lines.append(line.strip()+' '+str(line_number))           
        else:
            
            junk_lines.append([line_number,line])

# print "Finished reading"
# print("--- %s seconds ---\n" % (time.time() - start_time))

if len(junk_lines):
    # print "Merging stopped."
    # print str(len(junk_lines))+" line/lines is/are out of format [word][space][tag]"
    # print "Writing to junk.txt"
    
    junkFile=open(save_to+'junk.txt',"w")

    for line in junk_lines:
        junkFile.write(str(line[0])+':-')
        junkFile.write(line[1])

    junkFile.close()
    
    start_time=time.time()
    # print "Finished writing"
    # print("--- %s seconds ---" % (time.time() - start_time))

    # print "Please correct the format mismatches and re-merge"

else:
    # print "Merging to Corpus.txt\n Please wait."

    # start_time=time.time()

    corpusFile=open(save_to+"Corpus.txt","a")
    for line in formated_lines:
        corpusFile.write(line.strip()+' '+input_file_name.replace(' ','_')+'\n')
    corpusFile.close()

    start_time=time.time()
    # print "Finished writing"
    # print("--- %s seconds ---\n" % (time.time() - start_time))

    # print "Merging successfully completed."

    print "Done"
