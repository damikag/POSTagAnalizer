import time
start_time = time.time()
# input_file=raw_input()
# working_dir='/home/damika/Documents/Uni/Other/NLP Internship/POSTagAnalizer/python/'
input_file='/home/damika/Documents/Uni/Other/NLP Internship/POSTagAnalizer/python/tagged.txt'
# op=open("out.out",'w')
Word_dictionary={}
junk_lines=[]
print "Reading........"

class Word:
    def __init__(self,word):
        self.tag_dic={}
        self.word=word
        self.percetage={}
        self.wordCount=0
        self.wordTag_count={}

    def addPair(self,tag,line_number):
        self.wordCount+=1
        if tag in self.tag_dic:
            self.tag_dic[tag].append(line_number)
        else:
            self.tag_dic[tag]=[line_number]
            self.wordTag_count[tag]=0
        self.wordTag_count[tag]+=1

    def writeToFile(self):
        for tag in self.tag_dic.keys():
       
            Outfile=open('ans/AA'+str(hash(self.word))+tag+'.txt','w')
            for item in self.tag_dic[tag]:
                # print item
                Outfile.write(str(item))
                Outfile.write('\n')
            Outfile.close()

    def noOfTags(self):
        return len(self.tag_dic.keys())

    def calcPercentage(self):
        lst=[]

        for tag in self.tag_dic.keys():
            self.percetage[tag]=float(len(self.tag_dic[tag]))/self.wordCount*100
            lst.append([tag,self.percetage[tag]])
        
        return lst

    def printTags(self):
        for tag in self.tag_dic.keys():
            print tag

    def printLineNumbers(self,tag):
        cnt=0
        if tag in self.tag_dic.keys():
            for ln in self.tag_dic[tag]:
                print ln
                if cnt==10:return
                cnt+=1
        else:
            print 'Tag not found'    

    def writeWordTtoFile(self,outputfile,input_file):
        for tag in self.tag_dic.keys():
            for ln in self.tag_dic[tag]:
                if self.word=='\\':
                    outputfile.write('\\\\ '+tag+' '+str(ln)+' '+input_file+'\n')
                else:
                    outputfile.write(self.word+' '+tag+' '+str(ln)+' '+input_file+'\n')

def WriteProcessedCorpus(Word_dictionary,outputfile_name,input_file):
    outputfile=open(outputfile_name,"w")

    for word in Word_dictionary.keys():
        if Word_dictionary[word].noOfTags() >1:
            Word_dictionary[word].writeWordTtoFile(outputfile,input_file)


with open(input_file) as file: 
    line_number=0 

    for line in file:

        line_number+=1
        
        if len(line.strip().split())==2:
             
            word,tag=line.strip().split()
           
            if word in Word_dictionary:
                Word_dictionary[word].addPair(tag,line_number)
            else:
                Word_dictionary[word]= Word(word)
                Word_dictionary[word].addPair(tag,line_number)
        else:
            junk_lines.append(line)

print "Finished reading"
print("--- %s seconds ---" % (time.time() - start_time))

start_time=time.time()

WriteProcessedCorpus(Word_dictionary,"/home/damika/Documents/Uni/Other/NLP Internship/POSTagAnalizer/python/Testing/newCorpus.txt","tagged00")

print "Finished writing"
print("--- %s seconds ---" % (time.time() - start_time))
