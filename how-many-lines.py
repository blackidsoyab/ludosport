import glob

def lines_of_code(folders_to_use):

	list_of_project_files = []
	sum_all_lines_of_code = 0

	for s in folders_to_use:
		
		list_of_project_files.extend(glob.glob("body/" + s + "/*.php"))

	for s in list_of_project_files:
		
		with open(s) as f:
			for i, l in enumerate(f):
				pass
		sum_all_lines_of_code += i+1

	return "You wrote " + str(sum_all_lines_of_code) + " lines of code for this project."

folders_to_use = ["controllers", "models", "views", "helpers", "libraries"]

print lines_of_code(folders_to_use)
